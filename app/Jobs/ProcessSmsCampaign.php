<?php

namespace App\Jobs;

use App\Models\SmsApi;
use App\Models\SmsCampaign;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSmsCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The podcast instance.
     *
     * @var \App\Models\SmsCampaign
     */
    protected $smsCampaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsCampaign $smsCampaign)
    {
        $this->smsCampaign = $smsCampaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $smsGateway = SmsApi::where('status', '1')->first();
        if (!$smsGateway)
            return $this->smsCampaign->update(['status' => 'Failed']);
        
        $totalUsers = User::role($this->smsCampaign->contact_type)->where('status', '1')->count();
        $iterations = ceil($totalUsers / 10);

        $counter = 1;
        User::role($this->smsCampaign->contact_type)->where('status', '1')->chunk(10, function ($users) use (&$counter, $iterations) {
            ProcessSms::dispatch($this->smsCampaign, $users, ($counter == $iterations));
            $counter++;
        });
    }
}
