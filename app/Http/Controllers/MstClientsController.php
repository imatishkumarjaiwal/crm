<?php

namespace App\Http\Controllers;


use App\Models\References;
use App\Models\MstClients;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class MstClientsController extends Controller
{
    public function index()
    {
        return view('mst_clients');
    }

    public function manageClients($client_Id = '')
    {
        $mst_clients = null;
        $references = [];

        if (!empty($client_Id)) {
            $mst_clients = MstClients::find($client_Id);

            if (!$mst_clients) {
                return redirect()->route('mst_clients.index')->withErrors(['error' => 'Clients member not found.']);
            }

        }

        return view('manageClients', compact('mst_clients', 'references'));
    }

    

    public function getClients(Request $request)
    {
        if ($request->ajax()) {
            $data = MstClients::select([
                    'client_id',
                    'client_first_name',
                    'client_last_name',
                    'client_email',
                    'client_mobile',
                    'client_createdon',
                    'client_updatedon'
            ])
            ->where('client_deleted', 'N')
            ->orderBy('client_createdon', 'DESC');
            return DataTables::of($data)
                ->addColumn('client_createdon', function ($row) {
                    return Carbon::parse($row->client_createdon)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('mst_clients.edit', $row->client_id);
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->client_id . '"> &nbsp; ';
                    $action .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function insertClients(Request $request)
    {
        try {

            $validator = $this->validateClients($request);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

        
            $mst_clients = new MstClients();
            $mst_clients->fill($request->all());
            $mst_clients->save();

            // $this->createUser($mst_clients, $request);

            return response()->json(['status' => 'success', 'message' => 'Clients member created successfully!']);

        } catch (\Exception $e) {
            Log::error('Error inserting mst_clients record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the mst_clients. Please try again later.'], 500);
        }
    }

    public function updateClients(Request $request)
    {
        try {
            $validator = $this->validateClients($request, $request->client_id);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $mst_clients = MstClients::findOrFail($request->client_id);
            $mst_clients->fill($request->all());
            $mst_clients->client_mobile = $request->client_mobile;
            $mst_clients->client_email = $request->client_email;
         
            $mst_clients->client_updatedby = $request->session()->get('USER_ID');
            $mst_clients->client_updatedon = now();
            $mst_clients->save();

            // $this->updateUser($mst_clients, $request);


            return response()->json(['status' => 'success', 'message' => 'Clients member updated successfully!']);

        } catch (\Exception $e) {
            Log::error('Error updating mst_clients record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the mst_clients. Please try again later.'], 500);
        }
    }


    private function validateClients(Request $request, $client_Id = null)
    {
        $rules = [
            'client_first_name' => 'required|string|max:255',
            'client_last_name' => 'required|string|max:255',
            'client_mobile' => [
                'required',
                'digits:10',
                $client_Id ? 'unique:mst_clients,client_mobile,' . $client_Id . ',client_id' : 'unique:mst_clients,client_mobile',
            ],
            'client_email' => [
                'required',
                'email',
                'max:255',
                $client_Id ? 'unique:mst_clients,client_email,' . $client_Id . ',client_id' : 'unique:mst_clients,client_email',
            ],
        ];
    
        return FacadesValidator::make($request->all(), $rules);
    }


    private function createUser(MstClients $mst_clients, Request $request)
    {
        $user = new Users();
        $user->client_id = $mst_clients->client_id;
        $user->username = $mst_clients->client_mobile;
        $user->password = Hash::make($request->client_first_name . '@123');
        $user->created_by = $request->session()->get('USER_ID');
        $user->created_on = now();
        $user->save();
    }

    private function updateUser(MstClients $mst_clients, Request $request)
    {
        $user = Users::where('client_id', $mst_clients->client_id)->firstOrFail();
        $user->username = $mst_clients->client_mobile;
        $user->password = Hash::make($request->client_first_name . '@123');
        $user->updated_by = $request->session()->get('USER_ID');
        $user->updated_on = now();
        $user->save();
    }


    public function deleteClients(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $mst_clients = MstClients::findOrFail($id);
                $mst_clients->update(['client_deleted' => 'Y']);

                $user = Users::where('client_id', $mst_clients->client_id)->first();
                if ($user) {
                    $user->update(['client_deleted' => 'Y']);
                }
            }

            return response()->json([
                'message' => 'Selected mst_clients members have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting mst_clients record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the mst_clients and user records as deleted.']);
        }
    }
}

