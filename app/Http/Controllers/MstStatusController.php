<?php

namespace App\Http\Controllers;

use App\Models\MstStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MstStatusController extends Controller
{
    public function index()
    {
        return view('mst_status');
    }

    public function saveMstStatus(Request $request)
    {
        // Validate the request data
        $request->validate([
            'status_name' => 'required|string|max:255'
        ]);

        try {
            if ($request->status_id) {
                $mst_status = MstStatus::find($request->status_id);
                if (!$mst_status) {
                    return response()->json(['error' => 'MstStatus not found.'], 404);
                }
                $mst_status->status_updatedby = $request->session()->get('USER_ID');
                $mst_status->status_updatedon = now();
           
                $message = 'MstStatus has been updated successfully!';
            } else {
                $mst_status = new MstStatus();
                $mst_status->status_createdby = $request->session()->get('USER_ID');
                $mst_status->status_createdon = now();
  
                $message = 'MstStatus has been added successfully!';
            }

            $mst_status->fill($request->all());
            $mst_status->save();

            return response()->json(['mst_status' => 'success', 'message' => $message]);

        } catch (\Exception $e) {
            Log::error('Error saving mst_status record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the mst_status. Please try again later.'], 500);
        }
    }


    public function getMstStatusRecords(Request $request)
    {
        if ($request->ajax()) {
            $data = MstStatus::select(['status_id', 'status_name', 'status_desc', 'status_updatedon'])
                ->where('status_deleted', 'N')
                ->orderBy('status_updatedon', 'DESC');

            return DataTables::of($data)
                ->addColumn('status_updatedon', function ($row) {
                    return Carbon::parse($row->status_updatedon)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->status_id . '"> &nbsp; ';
                    $action .= '<a href="javascript:void(0)" data-id="' . $row->status_id . '" class="edit btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getMstStatus($statusId) {
        $statusId = MstStatus::find($statusId);
        return $statusId ? response()->json(['mst_status' => 'success', 'data' => $statusId], 200) : response()->json(['mst_status' => 'error', 'message' => 'MstStatus not found.'], 404);
    }

    public function deleteMstStatus(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $mst_status = MstStatus::findOrFail($id);
                $mst_status->update(['status_deleted' => 'Y']);
            }

            return response()->json([
                'message' => 'Selected mst_status have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting mst_status record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the mst_status records as deleted.']);
        }
    }


}
