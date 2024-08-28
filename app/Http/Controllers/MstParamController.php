<?php

namespace App\Http\Controllers;

use App\Models\MstParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MstParamController extends Controller
{
    public function index()
    {
        $setting = MstParam::first();
        return view('mst_param', compact('setting'));
    }

    public function updateParams(Request $request)
    {
        try {
            $validated = $request->validate([
                'site_name' => 'required|string|max:50',
                'site_currency_id' => 'required|integer',
                'site_email' => 'required|email|max:50',
                'site_phone' => 'required|string|max:100',
                'site_fax' => 'nullable|string|max:100',
                'site_url' => 'required|url|max:100',
                'site_incharge' => 'required|string|max:100',
                'site_tax_rate' => 'nullable|numeric',
                'site_add_time_hh_mm' => 'nullable|numeric',
                'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'site_address' => 'required|string',
            ]);

            $setting = MstParam::firstOrNew(['site_id' => 1]);
            $setting->site_name = $validated['site_name'];
            $setting->site_currency_id = $validated['site_currency_id'];
            $setting->site_email = $validated['site_email'];
            $setting->site_phone = $validated['site_phone'];
            $setting->site_fax = $validated['site_fax'] ?? '';
            $setting->site_url = $validated['site_url'];
            $setting->site_incharge = $validated['site_incharge'];
            $setting->site_tax_rate = $validated['site_tax_rate'] ?? null;
            $setting->site_add_time_hh_mm = $validated['site_add_time_hh_mm'] ?? null;
            $setting->site_address = $validated['site_address'];

            if ($request->hasFile('site_logo')) {
                $file = $request->file('site_logo');
                $path = $file->store('site_files', 'public');
                $setting->site_logo = $path;
            }

            $setting->save();
            return response()->json(['status' => 'success', 'message' => 'Site settings updated successfully.']);

        } catch (\Exception $e) {

            Log::error('Error inserting mst_staff record: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the settings. Please try again later.'], 500);
        }
    }
}
