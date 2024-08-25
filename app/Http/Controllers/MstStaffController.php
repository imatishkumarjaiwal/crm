<?php

namespace App\Http\Controllers;

use App\Models\References;
use App\Models\MstStaff;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class MstStaffController extends Controller
{
    public function index()
    {
        return view('mst_staff');
    }

    public function manageStaff($staffId = '')
    {
        $mst_staff = null;
        $references = [];

        if (!empty($staffId)) {
            $mst_staff = MstStaff::find($staffId);

            if (!$mst_staff) {
                return redirect()->route('mst_staff.index')->withErrors(['error' => 'Staff member not found.']);
            }

            $references = References::where('staff_id', $staffId)->get();
        }

        return view('manageStaff', compact('mst_staff', 'references'));
    }

    

    public function getStaffs(Request $request)
    {
        if ($request->ajax()) {
            $data = MstStaff::select([
                    'staff_id',
                    'staff_first_name',
                    'staff_last_name',
                    'staff_email',
                    'staff_mobile',
                    'staff_createdon',
                    'staff_updatedon'
            ])
            ->where('staff_deleted', 'N')
            ->orderBy('staff_createdon', 'DESC');
            return DataTables::of($data)
                ->addColumn('staff_createdon', function ($row) {
                    return Carbon::parse($row->staff_createdon)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('mst_staff.edit', $row->staff_id);
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->staff_id . '"> &nbsp; ';
                    $action .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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

            $photoPath = $this->handleFileUpload($request, 'staff_photo', 'photos');
            $aadharFilePath = $this->handleFileUpload($request, 'staff_aadhar_file', 'aadhar_files');
            $panFilePath = $this->handleFileUpload($request, 'staff_pan_file', 'pan_files');

            $mst_staff = new MstStaff();
            $mst_staff->fill($request->all());
            $mst_staff->staff_photo = $photoPath;
            $mst_staff->staff_aadhar_file = $aadharFilePath;
            $mst_staff->staff_pan_file = $panFilePath;
            $mst_staff->staff_createdby = $request->session()->get('USER_ID');
            $mst_staff->staff_createdon = now();
            $mst_staff->save();

            $this->createUser($mst_staff, $request);

            $this->saveReferences($mst_staff->staff_id, $request->references, $request);

            return response()->json(['status' => 'success', 'message' => 'Staff member created successfully!']);

        } catch (\Exception $e) {
            Log::error('Error inserting mst_staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the mst_staff. Please try again later.'], 500);
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
            $mst_staff = MstStaff::findOrFail($request->staff_id);
            $mst_staff->fill($request->all());
            $mst_staff->staff_mobile = $request->staff_mobile;
            $mst_staff->staff_email = $request->staff_email;
            if ($request->hasFile('staff_photo')) {
                $mst_staff->staff_photo = $this->handleFileUpload($request, 'staff_photo', 'photos');
            }
            if ($request->hasFile('staff_aadhar_file')) {
                $mst_staff->staff_aadhar_file = $this->handleFileUpload($request, 'staff_aadhar_file', 'aadhar_files');
            }
            if ($request->hasFile('staff_pan_file')) {
                $mst_staff->staff_pan_file = $this->handleFileUpload($request, 'staff_pan_file', 'pan_files');
            }
            $mst_staff->staff_updatedby = $request->session()->get('USER_ID');
            $mst_staff->staff_updatedon = now();
            $mst_staff->save();

            $this->updateUser($mst_staff, $request);

            if ($request->has('reference_delete_ids')) {
                $deleteIds = explode(',', $request->reference_delete_ids);
                if (!empty($deleteIds)) {
                    $deleted = References::whereIn('id', $deleteIds)->delete();
                }
            }

            if ($request->has('references')) {
                $this->saveReferences($mst_staff->staff_id, $request->references, $request, true);
            }

            return response()->json(['status' => 'success', 'message' => 'Staff member updated successfully!']);

        } catch (\Exception $e) {
            Log::error('Error updating mst_staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the mst_staff. Please try again later.'], 500);
        }
    }


    private function validateStaff(Request $request, $staffId = null)
    {
        $rules = [
            'staff_first_name' => 'required|string|max:255',
            'staff_last_name' => 'required|string|max:255',
            'staff_mobile' => [
                'required',
                'digits:10',
                $staffId ? 'unique:mst_staff,staff_mobile,' . $staffId . ',staff_id' : 'unique:mst_staff,staff_mobile',
            ],
            'staff_email' => [
                'required',
                'email',
                'max:255',
                $staffId ? 'unique:mst_staff,staff_email,' . $staffId . ',staff_id' : 'unique:mst_staff,staff_email',
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

    private function createUser(MstStaff $mst_staff, Request $request)
    {
        $user = new Users();
        $user->staff_id = $mst_staff->staff_id;
        $user->username = $mst_staff->staff_mobile;
        $user->password = Hash::make($request->staff_first_name . '@123');
        $user->created_by = $request->session()->get('USER_ID');
        $user->created_on = now();
        $user->save();
    }

    private function updateUser(MstStaff $mst_staff, Request $request)
    {
        $user = Users::where('staff_id', $mst_staff->staff_id)->firstOrFail();
        $user->username = $mst_staff->staff_mobile;
        $user->password = Hash::make($request->staff_first_name . '@123');
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
                $newReference->save();
            }
        }
    }

    public function deleteStaff(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $mst_staff = MstStaff::findOrFail($id);
                $mst_staff->update(['staff_deleted' => 'Y']);

                $user = Users::where('staff_id', $mst_staff->staff_id)->first();
                if ($user) {
                    $user->update(['staff_deleted' => 'Y']);
                }
            }

            return response()->json([
                'message' => 'Selected mst_staff members have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting mst_staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the mst_staff and user records as deleted.']);
        }
    }
}
