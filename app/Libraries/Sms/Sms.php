<?php

namespace App\Libraries\Sms;

use App\Libraries\Sms\Gateways\Clickatell;
use App\Libraries\Sms\Gateways\Nexmo;
use App\Libraries\Sms\Gateways\Plivo;
use App\Libraries\Sms\Gateways\Twilio;
use App\Models\SmsApi;

class Sms
{
    protected $smsGatewayConfig;
    protected $to;
    protected $message;

    function __construct()
    {
        $smsGateway = SmsApi::where('status', '1')->first();
        if (!$smsGateway)
            return ['success' => FALSE, 'message' => 'No active SMS gateway found!'];
        $this->smsGatewayConfig = $smsGateway;
    }

    public function send($to, string $message)
    {
        $this->to = $to;
        $this->message = $message;

        switch($this->smsGatewayConfig->gateway) {
            case 'twilio':
                return $this->twilio();
                break;
            case 'nexmo':
                return $this->nexmo();
                break;
            case 'clickatell':
                return $this->clickatell();
                break;
            case 'plivo':
                return $this->plivo();
                break;
        }
    }

    private function twilio()
    {
        if (is_array($this->to))
            return Twilio::sendBulkSms($this->smsGatewayConfig, $this->to, $this->message);
        else
            return Twilio::sendSms($this->smsGatewayConfig, $this->to, $this->message);
    }

    public function plivo()
    {
        if (is_array($this->to))
            return Plivo::sendBulkSms($this->smsGatewayConfig, $this->to, $this->message);
        else
            return Plivo::sendSms($this->smsGatewayConfig, $this->to, $this->message);
    }

    private function nexmo()
    {
        if(is_array($this->to))
            return Nexmo::sendBulkSms($this->smsGatewayConfig, $this->to, $this->message);
        else
            return Nexmo::sendSms($this->smsGatewayConfig, $this->to, $this->message);
    }

    public function clickatell()
    {
        if(is_array($this->to))
            return Clickatell::sendBulkSms($this->smsGatewayConfig, $this->to, $this->message);
        else
            return Clickatell::sendSms($this->smsGatewayConfig, $this->to, $this->message);

    }
}
