<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use App\Models\Users;
use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class StaffsController extends Controller
{

    public function getStaffs(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $data = Staffs::select(['id', 'first_name', 'last_name', 'email', 'mobile_number']);
                return DataTables::of($data)
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="'.$row->id.'"><i class="bx bx-edit-alt"></i></a>';
                        $btn .= '&nbsp; <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
    }
    /**
     * Display a listing of the resource.
     */
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
        // Check if staff_id is present in the request
        $isUpdate = $request->has('staff_id') && !empty($request->staff_id);

        // Define validation rules
        $rules = [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => [
                'required',
                'digits:10',
                $isUpdate ? 'unique:staffs,mobile_number,' . $request->staff_id : 'unique:staffs,mobile_number'
            ],
            'email' => [
                'required',
                'email',
                $isUpdate ? 'unique:staffs,email,' . $request->staff_id : 'unique:staffs,email'
            ],
            'password' => 'required|string|min:8',
        ];
    
        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $staff = Staffs::updateOrCreate([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => $request->session()->get('USER_ID'),
            'created_on' => now(),
            'updated_by' => $request->session()->get('USER_ID'),
            'updated_on' => now(),
        ]);
    
        // Create or update the user record associated with the staff
        $user = Users::updateOrCreate([
            'username' => $staff->mobile_number,
            'password' => Hash::make($request->password),
            'staff_id' => $staff->id,
            'created_by' => $request->session()->get('USER_ID'),
            'created_on' => now(),
            'updated_by' => $request->session()->get('USER_ID'),
            'updated_on' => now(),
        ]);
    
        return response()->json(['message' => 'Staff saved successfully!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Staffs $staffs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staffs $staffs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staffs $staffs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staffs $staffs)
    {
        //
    }
}
