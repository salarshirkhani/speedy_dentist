<?php

namespace App\Jobs;

use App\Models\EmailCampaign;
use App\Models\EmailCampaignLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The emailCampaign model instance.
     *
     * @var \App\Models\emailCampaign
     */
    protected $emailCampaign;

    /**
     * The User model collection.
     *
     * @var Illuminate\Support\Collection
     */
    protected $users;

    /**
     * SMTP config id.
     *
     * @var int
     */
    protected $smtpConfigurationId;

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
    public function __construct(EmailCampaign $emailCampaign, $smtpConfigurationId, $users, $lastChunk)
    {
        $this->emailCampaign = $emailCampaign;
        $this->smtpConfigurationId = $smtpConfigurationId;
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
        $logData = [];
        foreach ($this->users as $user) {
            $text = str_replace('#NAME#', $user->name, $this->emailCampaign->message);
            $text = str_replace('#PHONE#', $user->phone, $text);
            $text = str_replace('#Email_ADDRESS#', $user->email, $text);

            Mail::send([], [], function ($message) use ($text, $user) {
                $message->to($user->email)
                    ->subject($this->emailCampaign->campaign_name)
                    ->setBody($text);
            });

            $logData[] = [
                'user_id' => $user->id,
                'email_campaign_id' => $this->emailCampaign->id,
                'smtp_configuration_id' => $this->smtpConfigurationId,
                'status' => (count(Mail::failures()) > 0) ? '0' : '1',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        EmailCampaignLog::insert($logData);

        if ($this->lastChunk)
            $this->emailCampaign->update(['status' => 'Completed']);
    }
}
