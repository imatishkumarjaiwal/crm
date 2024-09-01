<?php

namespace App\Http\Controllers;

use App\Models\MstClients;
use App\Models\MstStaff;
use App\Models\TrnJobs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TrnJobsController extends Controller
{
    public function index()
    {
        return view('trn_jobs');
    }

    public function getTrnJobRecords(Request $request)
    {
        if ($request->ajax()) {
            $jobs = TrnJobs::with([
                    'client:client_id,client_salutation,client_first_name,client_middle_name,client_last_name', 
                    'staff:staff_id,staff_salutation,staff_first_name,staff_middle_name,staff_last_name'
                ])
                ->where('job_deleted', 'N')
                ->select([
                    'job_id',
                    'job_date',
                    'job_client_id',
                    'job_staff_id',
                    'job_total_amount',
                    'job_property_details',
                    'job_createdon',
                ])
                ->orderBy('job_createdon', 'desc');
    
            return DataTables::of($jobs)
                ->addIndexColumn()
                ->addColumn('job_date', function ($job) {
                    return Carbon::parse($job->job_date)->format('d-m-Y');
                })
                ->addColumn('client_name', function ($job) {
                    return $job->client ? $job->client->client_salutation . ' ' . $job->client->client_first_name . ' ' . $job->client->client_last_name : 'N/A';
                })
                ->addColumn('staff_name', function ($job) {
                    return $job->staff ? $job->staff->staff_salutation . ' ' . $job->staff->staff_first_name . ' ' . $job->staff->staff_last_name : 'N/A';
                })
                ->addColumn('job_createdon', function ($job) {
                    return Carbon::parse($job->job_createdon)->format('d-m-Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('trn_jobs.edit', $row->job_id);
                    $action = '<input class="form-check-input select_checkbox" type="checkbox" data-id="' . $row->job_id . '"> &nbsp; ';
                    $action .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="bx bx-edit-alt"></i></a>';
                    return $action;
                })
                ->make(true);
        }
    }

    public function manageJobs($jobId='')
    {
        $jobs = TrnJobs::find($jobId);
        $clients = MstClients::get(['client_id', 'client_salutation', 'client_first_name', 'client_middle_name', 'client_last_name']);
        $staffs = MstStaff::get(['staff_id', 'staff_salutation', 'staff_first_name', 'staff_middle_name', 'staff_last_name']);
        
        return view('manageJobs', compact('clients', 'staffs', 'jobs'));
    }

    public function insertJob(Request $request)
    {
        $request->validate([
            'job_received_from' => 'required'
        ]);
        try {
            $trn_job = new TrnJobs();
            $trn_job->fill($request->all());
            $trn_job->job_createdby = $request->session()->get('USER_ID');
            $trn_job->job_createdon = now();
            $trn_job->save();

            return response()->json(['status' => 'success', 'message' => 'Job created successfully!']);
        } catch (\Exception $e) {
            Log::error('Error inserting trn_job record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the job. Please try again later.'], 500);
        }
    }

    public function updateJob(Request $request)
    {
        $request->validate([
            'job_received_from' => 'required',
            // Add other validation rules as needed
        ]);

        try {
            $trn_job = TrnJobs::findOrFail($request->job_id);
            $trn_job->fill($request->all());
            $trn_job->job_updatedby = $request->session()->get('USER_ID');
            $trn_job->job_updatedon = now();
            $trn_job->save();

            return response()->json(['status' => 'success', 'message' => 'Job updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Error updating trn_job record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the job. Please try again later.'], 500);
        }
    }

    public function deleteJobs(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $job = TrnJobs::findOrFail($id);
                $job->update(['job_deleted' => 'Y']);
            }

            return response()->json([
                'message' => 'Selected Jobs have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting job record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the job records as deleted.']);
        }
    }
}
