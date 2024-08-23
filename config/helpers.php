<?php

use App\Models\Staffs;
use App\Models\User;

if (!function_exists('getUserInfo')) {
    function getUserInfo($userId) {
        $userInfo = [];
        $user = User::find($userId);

        if ($user) {
            if ($user->staff_id) {
                $staff = Staffs::find($user->staff_id);
                if ($staff) {
                    $userInfo['user_name'] = $staff->first_name . ' ' . $staff->last_name;
                    $userInfo['user_photo'] = $staff->photo ?? 'photos/avatar-1.jpg';
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

