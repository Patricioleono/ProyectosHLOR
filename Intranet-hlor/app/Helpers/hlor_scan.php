<?php

namespace App\Helpers;

use Illuminate\Routing\Controller as Base_controller;

class hlor_scan extends Base_controller
{
    public static function get_ip_address($user)
    {
        $ip_user_address = 'LOCALHOST';
        if (getenv('HTTP_CLIENT_IP')) {
            $ip_user_address = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip_user_address = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip_user_address = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip_user_address = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip_user_address = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ip_user_address = getenv('REMOTE_ADDR');
        }

        return $ip_user_address .' '. $user;
    }
}
