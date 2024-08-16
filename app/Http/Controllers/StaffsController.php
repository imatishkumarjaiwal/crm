<?php

namespace App\Http\Controllers;

use App\Models\References;
use App\Models\Staffs;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class StaffsController extends Controller
{

    public function index()
    {
        return view('admin.staffs');
    }

    public function manageStaff($staffId = '')
    {
        $staff = null;
        $references = [];

        if (!empty($staffId)) {
            $staff = Staffs::find($staffId);

            if (!$staff) {
                return redirect()->route('admin.staff.index')->withErrors(['error' => 'Staff member not found.']);
            }

            $references = References::where('staff_id', $staffId)->get();
        }

        return view('admin.manageStaff', compact('staff', 'references'));
    }

    

    public function getStaffs(Request $request)
    {
        if ($request->ajax()) {
            $data = Staffs::select(['id', 'first_name', 'last_name', 'email', 'mobile_number', 'updated_on'])
                ->where('deleted_status', 0)
                ->orderBy('updated_on', 'DESC');

            return DataTables::of($data)
                ->addColumn('updated_on', function ($row) {
                    return Carbon::parse($row->updated_on)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.staff.edit', $row->id);
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->id . '"> &nbsp; ';
                    $action .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getStaffDataForEdit($staffId) {
        $staff = Staffs::find($staffId);
        return $staff ? response()->json(['status' => 'success', 'data' => $staff], 200) : response()->json(['status' => 'error', 'message' => 'Staff member not found.'], 404);
    }

    public function insertStaff(Request $request)
    {
        try {

            $validator = $this->validateStaff($request);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $photoPath = $this->handleFileUpload($request, 'photo', 'photos');
            $aadharFilePath = $this->handleFileUpload($request, 'aadhar_file', 'aadhar_files');
            $panFilePath = $this->handleFileUpload($request, 'pan_file', 'pan_files');

            $staff = new Staffs();
            $staff->fill($request->all());
            $staff->photo = $photoPath;
            $staff->aadhar_file = $aadharFilePath;
            $staff->pan_file = $panFilePath;
            $staff->created_by = $request->session()->get('USER_ID');
            $staff->created_on = now();
            $staff->save();

            $this->createUser($staff, $request);

            $this->saveReferences($staff->id, $request->references, $request);

            return response()->json(['status' => 'success', 'message' => 'Staff member created successfully!']);

        } catch (\Exception $e) {
            Log::error('Error inserting staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the staff. Please try again later.'], 500);
        }
    }

    public function updateStaff(Request $request)
    {
        try {
            $validator = $this->validateStaff($request, $request->staff_id);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $staff = Staffs::findOrFail($request->staff_id);
            $staff->fill($request->all());
            $staff->mobile_number = $request->mobile_number;
            $staff->email = $request->email;
            if ($request->hasFile('photo')) {
                $staff->photo = $this->handleFileUpload($request, 'photo', 'photos');
            }
            if ($request->hasFile('aadhar_file')) {
                $staff->aadhar_file = $this->handleFileUpload($request, 'aadhar_file', 'aadhar_files');
            }
            if ($request->hasFile('pan_file')) {
                $staff->pan_file = $this->handleFileUpload($request, 'pan_file', 'pan_files');
            }
            $staff->updated_by = $request->session()->get('USER_ID');
            $staff->updated_on = now();
            $staff->save();

            $this->updateUser($staff, $request);

            if ($request->has('reference_delete_ids')) {
                $deleteIds = explode(',', $request->reference_delete_ids);
                if (!empty($deleteIds)) {
                    $deleted = References::whereIn('id', $deleteIds)->delete();
                }
            }

            if ($request->has('references')) {
                $this->saveReferences($staff->id, $request->references, $request, true);
            }

            return response()->json(['status' => 'success', 'message' => 'Staff member updated successfully!']);

        } catch (\Exception $e) {
            Log::error('Error updating staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the staff. Please try again later.'], 500);
        }
    }


    private function validateStaff(Request $request, $staffId = null)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => [
                'required',
                'digits:10',
                $staffId ? 'unique:staffs,mobile_number,' . $staffId : 'unique:staffs,mobile_number',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                $staffId ? 'unique:staffs,email,' . $staffId : 'unique:staffs,email',
            ],
            'references.*.name' => 'required|string|max:255',
            'references.*.relationship' => 'required|string|max:255',
            'references.*.mobile' => 'required|digits:10',
        ];

        return FacadesValidator::make($request->all(), $rules);
    }

    private function handleFileUpload(Request $request, $fieldName, $directory)
    {
        if ($request->hasFile($fieldName)) {
            $uniqueId = time() . '_' . uniqid();
            return $request->file($fieldName)->storeAs($directory, $uniqueId . '_' . $request->file($fieldName)->getClientOriginalName(), 'public');
        }
        return null;
    }

    private function createUser(Staffs $staff, Request $request)
    {
        $user = new Users();
        $user->staff_id = $staff->id;
        $user->username = $staff->mobile_number;
        $user->password = Hash::make($request->first_name . '@123');
        $user->created_by = $request->session()->get('USER_ID');
        $user->created_on = now();
        $user->save();
    }

    private function updateUser(Staffs $staff, Request $request)
    {
        $user = Users::where('staff_id', $staff->id)->firstOrFail();
        $user->username = $staff->mobile_number;
        $user->password = Hash::make($request->first_name . '@123');
        $user->updated_by = $request->session()->get('USER_ID');
        $user->updated_on = now();
        $user->save();
    }

   private function saveReferences($staffId, $references, Request $request, $isUpdate = false)
    {   
        foreach ($references as $reference) {
            if (isset($reference['reference_id'])) {
                $existingReference = References::find($reference['reference_id']);
                $existingReference->staff_id = $staffId;
                $existingReference->name = $reference['name'];
                $existingReference->relationship = $reference['relationship'];
                $existingReference->mobile = $reference['mobile'];
                $existingReference->updated_by = $request->session()->get('USER_ID');
                $existingReference->updated_on = now();
                $existingReference->save();
            } else {
                $newReference = new References();
                $newReference->staff_id = $staffId;
                $newReference->name = $reference['name'];
                $newReference->relationship = $reference['relationship'];
                $newReference->mobile = $reference['mobile'];
                $newReference->created_by = $request->session()->get('USER_ID');
                $newReference->created_on = now();
                $newReference->updated_by = $request->session()->get('USER_ID');
                $newReference->updated_on = now();
                $newReference->save();
            }
        }
    }

    public function deleteStaff(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $staff = Staffs::findOrFail($id);
                $staff->update(['deleted_status' => 1]);

                $user = Users::where('staff_id', $staff->id)->first();
                if ($user) {
                    $user->update(['deleted_status' => 1]);
                }
            }

            return response()->json([
                'message' => 'Selected staff members have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the staff and user records as deleted.']);
        }
    }

}
