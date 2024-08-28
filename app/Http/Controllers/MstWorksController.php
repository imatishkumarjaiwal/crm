<?php

namespace App\Http\Controllers;

use App\Models\MstWorks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MstWorksController extends Controller
{
    public function index()
    {
        return view('mst_works');
    }

    public function saveMstWorks(Request $request)
    {
        // Validate the request data
        $request->validate([
            'work_name' => 'required|string|max:255'
        ]);

        try {
            if ($request->work_id) {
                $work = MstWorks::find($request->work_id);
                if (!$work) {
                    return response()->json(['error' => 'Work not found.'], 404);
                }
                $work->work_updatedby = $request->session()->get('USER_ID');
                $work->work_updatedon = now();
                $message = 'Work has been updated successfully!';
            } else {
                $work = new MstWorks();
                $work->work_createdby = $request->session()->get('USER_ID');
                $work->work_createdon = now();
                $message = 'Work has been added successfully!';
            }

            $work->fill($request->all());
            $work->save();

            return response()->json(['status' => 'success', 'message' => $message]);

        } catch (\Exception $e) {
            Log::error('Error saving work record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the work. Please try again later.'], 500);
        }
    }


    public function getMstWorksRecords(Request $request)
    {
        if ($request->ajax()) {
            $data = MstWorks::select(['work_id', 'work_name', 'work_desc', 'work_updatedon'])
                ->where('work_deleted', 'N')
                ->orderBy('work_updatedon', 'DESC');

            return DataTables::of($data)
                ->addColumn('work_updatedon', function ($row) {
                    return Carbon::parse($row->work_updatedon)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->work_id . '"> &nbsp; ';
                    $action .= '<a href="javascript:void(0)" data-id="' . $row->work_id . '" class="edit btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getMstWorks($work_id) {
        $work_id = MstWorks::find($work_id);
        return $work_id ? response()->json(['status' => 'success', 'data' => $work_id], 200) : response()->json(['status' => 'error', 'message' => 'Work not found.'], 404);
    }

    public function deleteMstWorks(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $work = MstWorks::findOrFail($id);
                $work->update(['work_deleted' => 'Y']);
            }

            return response()->json([
                'message' => 'Selected mst_works have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting work record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the work records as deleted.']);
        }
    }

}
