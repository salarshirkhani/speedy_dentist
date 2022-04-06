<?php

namespace App\Jobs;

use App\Models\EmailCampaign;
use App\Models\SmtpConfiguration;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessEmailCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The podcast instance.
     *
     * @var \App\Models\EmailCampaign
     */
    protected $emailCampaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EmailCampaign $emailCampaign)
    {
        $this->emailCampaign = $emailCampaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $smtpConfiguration = SmtpConfiguration::where('status', '1')->latest()->first();
        if (!$smtpConfiguration)
            return $this->emailCampaign->update(['status' => 'Failed']);
        
        $totalUsers = User::role($this->emailCampaign->contact_type)->where('status', '1')->count();
        $iterations = ceil($totalUsers / 10);

        $counter = 1;
        User::role($this->emailCampaign->contact_type)->where('status', '1')->chunk(10, function ($users) use (&$counter, $iterations, $smtpConfiguration) {
            ProcessEmail::dispatch($this->emailCampaign, $smtpConfiguration->id, $users, ($counter == $iterations));
            $counter++;
        });
    }
}
