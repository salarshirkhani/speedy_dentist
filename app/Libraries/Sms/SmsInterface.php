<?php

namespace App\Libraries\Sms;

interface SmsInterface {
    public static function sendSms($config, string $to, string $message);
    public static function sendBulkSms($config, array $to, string $message);
}
