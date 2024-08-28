<?php

use App\Models\MstParam;
use App\Models\MstStaff;
use App\Models\User;

if (!function_exists('getUserInfo')) {
    function getUserInfo($userId) {
        $userInfo = [];
        $user = User::find($userId);

        if ($user) {
            if ($user->staff_id) {
                $staff = MstStaff::find($user->staff_id);
                if ($staff) {
                    $userInfo['user_name'] = $staff->staff_first_name . ' ' . $staff->staff_last_name;
                    $userInfo['user_photo'] = $staff->staff_photo ?? 'photos/avatar-1.jpg';
                }
            } else {
                $userInfo['user_name'] = $user->username;
                $userInfo['user_photo'] = 'photos/avatar-1.jpg';
            }
        } else {
            $userInfo['user_name'] = 'Guest';
            $userInfo['user_photo'] = 'photos/avatar-1.jpg';
        }

        return $userInfo;
    }
}


if (!function_exists('getSettingInfo')) {
    function getSettingInfo() {
        $siteInfo = [];
        $setting = MstParam::first();
        if ($setting) {
            $siteInfo = [
                'site_name' => $setting->site_name,
                'site_currency_id' => $setting->site_currency_id,
                'site_email' => $setting->site_email,
                'site_phone' => $setting->site_phone,
                'site_fax' => $setting->site_fax,
                'site_url' => $setting->site_url,
                'site_incharge' => $setting->site_incharge,
                'site_tax_rate' => $setting->site_tax_rate,
                'site_add_time_hh_mm' => $setting->site_add_time_hh_mm,
                'site_logo' => $setting->site_logo,
                'site_address' => $setting->site_address,
            ];
        }
        return $siteInfo;
    }
}

