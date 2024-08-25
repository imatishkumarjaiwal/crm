<?php

namespace App\Http\Controllers;

use App\Models\Holidays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class HolidaysController extends Controller
{
    public function index()
    {
        return view('holidays');
    }

    public function getHolidays(Request $request)
    {
        if ($request->ajax()) {
            $data = Holidays::select(['id', 'title', 'date', 'day','last_updated'])
                ->where('deleted_status', 0)
                ->orderBy('last_updated', 'DESC');

            return DataTables::of($data)
                ->addColumn('last_updated', function ($row) {
                    return Carbon::parse($row->last_updated)->format('d-m-Y h:i A');
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

    public function generateHolidayDates($from_date, $to_date, $days = null)
    {
        $datesWithDays = [];
        $start = Carbon::createFromFormat('Y-m-d', $from_date);
        $end = Carbon::createFromFormat('Y-m-d', $to_date);

        while ($start->lte($end)) {
            if ($days && in_array($start->dayOfWeekIso, $days)) {
                $datesWithDays[] = [
                    'date' => $start->format('Y-m-d'),
                    'day' => $start->format('l')
                ];
            } elseif (!$days) {
                $datesWithDays[] = [
                    'date' => $start->format('Y-m-d'),
                    'day' => $start->format('l')
                ];
            }
            $start->addDay();
        }
        return $datesWithDays;
    }

    public function getHoliday($holidayId) {
        $holidayId = Holidays::find($holidayId);
        return $holidayId ? response()->json(['status' => 'success', 'data' => $holidayId], 200) : response()->json(['status' => 'error', 'message' => 'Holiday not found.'], 404);
    }

    public function saveHoliday(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        try {
            $type = $request->input('type');
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $days = $request->input('days');

            if ($request->holiday_id) {
                $holiday = Holidays::find($request->holiday_id);

                if (!$holiday) {
                    return response()->json(['error' => 'Holiday not found.'], 404);
                }

                $holiday->title = $request->input('title');
                $holiday->date = $request->input('from_date');
                $holiday->day = Carbon::createFromFormat('Y-m-d', $request->input('from_date'))->format('l');
                $holiday->updated_by = $request->session()->get('USER_ID');
                $holiday->updated_on = now();
                $holiday->last_updated = now();
                $holiday->save();

                $message = 'Holiday has been updated successfully!';
            } else {
                if ($type == 'Multiple' && empty($days)) {
                    return response()->json(['error' => 'Please select at least one day.'], 400);
                }

                $datesWithDays = $this->generateHolidayDates($from_date, $to_date, $days);

                foreach ($datesWithDays as $dateWithDay) {
                    $holiday = new Holidays();
                    $holiday->title = $request->input('title');
                    $holiday->date = $dateWithDay['date'];
                    $holiday->day = $dateWithDay['day'];
                    $holiday->created_by = $request->session()->get('USER_ID');
                    $holiday->created_on = now();
                    $holiday->last_updated = now();
                    $holiday->save();
                }

                $message = 'Holidays have been inserted successfully!';
            }

            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error inserting holiday records: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the holidays. Please try again later.'], 500);
        }
    }

    public function deleteHoliday(Request $request)
    {
        try {
            $ids = explode(',', $request->input('ids'));
            foreach ($ids as $id) {
                $work = Holidays::findOrFail($id);
                $work->update(['deleted_status' => 1]);
            }

            return response()->json([
                'message' => 'Selected holidays have been deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting holiday record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while marking the holiday records as deleted.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Holidays $holidays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holidays $holidays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holidays $holidays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holidays $holidays)
    {
        //
    }
}
