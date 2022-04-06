<?php

namespace App\Libraries\Sms\Gateways;

use App\Libraries\Sms\SmsInterface;
use Twilio\Rest\Client;

class Twilio implements SmsInterface
{
    public static function sendSms($config, string $to, string $message)
    {
        $data = [
            'sms_api_id' => $config['id'],
            'delivery_id' => '',
            'status' => '0'
        ];

        $accountSid = $config['auth_id'];
        $authToken = $config['auth_token'];
        $twilioNumber = $config['sender_number'];
        try {
            $client = new Client($accountSid, $authToken);
            $response = $client->messages->create($to, ['from' => $twilioNumber, 'body' => $message]);
            $data['delivery_id'] = $response->sid;
            $data['status'] = '1';
            return $data;
        } catch(\Exception $e) {
            return $data;
        }
    }

    public static function sendBulkSms($config, array $to, string $message)
    {
        foreach ($to as $recipient) {
            $response[] = self::sendSms($config, $recipient, $message);
        }
        return $response;
    }
}
