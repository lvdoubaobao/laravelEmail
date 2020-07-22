<?php

namespace App\Jobs;

use App\EmailCorn;
use App\EmailTpl;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public  $emailTpl;
    public  $emailCorn;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user ,EmailTpl $emailTpl,EmailCorn $emailCorn)
    {
        $this->user=$user;
        $this->emailTpl=$emailTpl;
        $this->emailCorn=$emailCorn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

            \Illuminate\Support\Facades\Mail::to($this->user)->send(new \App\Mail\OrderShipped($this->emailTpl,$this->emailCorn));
             sleep(1);
            Log::channel('email_success')->info($this->user->email.':'.$this->emailTpl->name.':发送成功');


    }
    public function  failed(\Exception $exception){

        Log::channel('email_error')->error($this->user->email.':'.$this->emailTpl->name,[$exception->getMessage()]);

    }
}
