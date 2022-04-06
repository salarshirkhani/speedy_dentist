<?php

namespace App\Libraries\Sms\Gateways;

use App\Libraries\Sms\SmsInterface;
use Plivo\RestClient;

class Plivo implements SmsInterface
{
    public static function sendSms($config, string $to, string $message)
    {
        $accountSid = $config['auth_id'];
        $authToken = $config['auth_token'];
        $plivoNumber = $config['sender_number'];
        try {
            $client = new RestClient($accountSid,$authToken);
            $message = $client->messages->create($plivoNumber,[$to],$message);
        }  catch(\Exception $e) {
            return $message;
        }
    }

    public static function sendBulkSms($config, array $to, string $message)
    {
        $accountSid = $config['auth_id'];
        $authToken = $config['auth_token'];
        $plivoNumber = $config['sender_number'];
        try {
            $client = new RestClient($accountSid,$authToken);
            $message = $client->messages->create($plivoNumber,$to,$message);
        } catch(\Exception $e) {
            return $message;
        }
    }
}
