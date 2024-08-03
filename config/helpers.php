<?php

use App\Models\Staffs;
use App\Models\User;

if (!function_exists('getUserName')) {
   function getUserName($userId) {
       $user = User::find($userId);
       $userName = '';
       if ($user) {
            if ($user->staff_id) {
                $staff = Staffs::find($user->staff_id);
                if ($staff) {
                    $userName = $staff->first_name .' '. $staff->last_name;
                }
            }else{
                $userName = $user->username;
            }
       }
       return $userName;
   }
}