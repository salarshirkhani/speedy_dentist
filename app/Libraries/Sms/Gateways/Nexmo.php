<?php

namespace App\Libraries\Sms\Gateways;

use App\Libraries\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class Nexmo implements SmsInterface
{
    public static function sendSms($config, string $to, string $message)
    {
        $data = [
            'sms_api_id' => $config['id'],
            'delivery_id' => '',
            'status' => '0'
        ];
        $apiKey = $config['auth_id'];
        $apiSecret = $config['auth_token'];
        $from = $config['sender_number'];
        try {
            $response = Http::post('https://rest.nexmo.com/sms/json', [
                'api_key' => $apiKey,
                'api_secret' => $apiSecret,
                'from' => $from,
                'to' => $to,
                'text' => $message,
                'type' => 'text',
            ])->object();
            $data['delivery_id'] = $response->messages[0]['message-id'];
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
