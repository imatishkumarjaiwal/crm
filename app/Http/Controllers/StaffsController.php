<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class StaffsController extends Controller
{

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
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->id . '"> &nbsp; ';
                    $action .= '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function staffIndex()
    {
        return view('admin.staffIndex');
    }

    public function getStaffDataForEdit($staffId) {
        $staff = Staffs::find($staffId);
        return $staff ? response()->json(['status' => 'success', 'data' => $staff], 200) : response()->json(['status' => 'error', 'message' => 'Staff member not found.'], 404);
    }

    public function saveStaff(Request $request)
    {
        $isUpdate = $request->has('staff_id') && !empty($request->staff_id);

        $rules = [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => [
                'required',
                'digits:10',
                $isUpdate ? 'unique:staffs,mobile_number,' . $request->staff_id : 'unique:staffs,mobile_number',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $isUpdate ? 'unique:staffs,email,' . $request->staff_id : 'unique:staffs,email',
            ],
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $staff = Staffs::updateOrCreate(
                ['id' => $request->staff_id],
                [
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'mobile_number' => $request->mobile_number,
                    'email' => $request->email,
                    'address' => $request->address,
                    'updated_by' => $request->session()->get('USER_ID'),
                    'updated_on' => now()
                ]
            );

            if (!$isUpdate) {
                $staff->created_by = $request->session()->get('USER_ID');
                $staff->created_on = now();
                $staff->save();
            }

            $user = Users::updateOrCreate(
                ['staff_id' => $staff->id],
                [
                    'username' => $staff->mobile_number,
                    'password' => Hash::make($request->first_name . '@123'),
                    'updated_by' => $request->session()->get('USER_ID'),
                    'updated_on' => now(),
                ]
            );

            if (!$isUpdate) {
                $user->created_by = $request->session()->get('USER_ID');
                $user->created_on = now();
                $user->save();
            }

            $message = $isUpdate ? 'Staff member ' . $staff->first_name . ' ' . $staff->last_name . ' has been updated successfully!' : 'Staff member ' . $staff->first_name . ' ' . $staff->last_name . ' has been created successfully!';

            return response()->json(['message' => $message]);

        } catch (\Exception $e) {
            Log::error('Error saving staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the staff. Please try again later.']);
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
