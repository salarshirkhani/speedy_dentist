<?php

namespace App\Jobs;

use App\Libraries\Sms\Sms;
use App\Models\SmsCampaign;
use App\Models\SmsCampaignLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSms implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The SmsCampaign model instance.
     *
     * @var \App\Models\SmsCampaign
     */
    protected $smsCampaign;

    /**
     * The User model collection.
     *
     * @var Illuminate\Support\Collection
     */
    protected $users;

    /**
     * The last chunk indicator.
     *
     * @var bool
     */
    protected $lastChunk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsCampaign $smsCampaign, $users, $lastChunk)
    {
        $this->smsCampaign = $smsCampaign;
        $this->users = $users;
        $this->lastChunk = $lastChunk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sms = new Sms();
        $logData = [];
        foreach ($this->users as $user) {
            if (!$user->phone)
                continue;
            
            $message = str_replace('#NAME#', $user->name, $this->smsCampaign->message);
            $message = str_replace('#PHONE#', $user->phone, $message);
            $message = str_replace('#Email_ADDRESS#', $user->email, $message);

            $response = $sms->send($user->phone, $message);
            $logData[] = [
                'user_id' => $user->id,
                'sms_campaign_id' => $this->smsCampaign->id,
                'sms_api_id' => $response['sms_api_id'],
                'delivery_id' => $response['delivery_id'],
                'status' => $response['status'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        SmsCampaignLog::insert($logData);

        if ($this->lastChunk)
            $this->smsCampaign->update(['status' => 'Completed']);

    }
}
