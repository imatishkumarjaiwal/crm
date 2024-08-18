<?php

namespace App\Http\Controllers;

use App\Models\Works;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class WorksController extends Controller
{
    public function index()
    {
        return view('admin.works');
    }

    public function saveWork(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        try {
            if ($request->work_id) {
                $work = Works::find($request->work_id);
                if (!$work) {
                    return response()->json(['error' => 'Work not found.'], 404);
                }
                $work->updated_by = $request->session()->get('USER_ID');
                $work->updated_on = now();
                $work->last_updated = now();
                $message = 'Work has been updated successfully!';
            } else {
                $work = new Works();
                $work->created_by = $request->session()->get('USER_ID');
                $work->created_on = now();
                $work->last_updated = now();
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


    public function getWorks(Request $request)
    {
        if ($request->ajax()) {
            $data = Works::select(['id', 'title', 'description', 'updated_on'])
                ->where('deleted_status', 0)
                ->orderBy('updated_on', 'DESC');

            return DataTables::of($data)
                ->addColumn('updated_on', function ($row) {
                    return Carbon::parse($row->updated_on)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->id . '"> &nbsp; ';
                    $action .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getWork($workId) {
        $workId = Works::find($workId);
        return $workId ? response()->json(['status' => 'success', 'data' => $workId], 200) : response()->json(['status' => 'error', 'message' => 'Work not found.'], 404);
    }

    public function deleteWork(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $work = Works::findOrFail($id);
                $work->update(['deleted_status' => 1]);
            }

            return response()->json([
                'message' => 'Selected works have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting work record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the work records as deleted.']);
        }
    }
}
