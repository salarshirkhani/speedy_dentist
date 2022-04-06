<?php

namespace App\Libraries\Sms\Gateways;
use App\Libraries\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class Clickatell implements SmsInterface
{
    public static function sendSms($config, string $to, string $message)
    {
        $data = [
            'sms_api_id' => $config['id'],
            'delivery_id' => '',
            'status' => '0'
        ];
        $apiId = $config['api_id'];
        try {
            $response = Http::get('https://platform.clickatell.com/messages/http/send', [
                'apiKey' => $apiId,
                'to' => $to,
                'content' => $message,
            ])->object();
            $data['delivery_id'] = $response->messages[0]['apiMessageId'];
            $data['status'] = '1';
        } catch(\Exception $e) {
			return $data;
        }
    }

    public static function sendBulkSms($config, array $to, string $message)
    {
        ;
    }

}
