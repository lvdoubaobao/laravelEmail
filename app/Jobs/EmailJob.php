<?php

namespace App\Jobs;

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
    public $address;
    public $address_name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user ,EmailTpl $emailTpl,$address='',$address_name='')
    {
        $this->user=$user;
        $this->emailTpl=$emailTpl;
        $this->address=$address;
        $this->address_name=$address_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            \Illuminate\Support\Facades\Mail::to($this->user->email)->send(new \App\Mail\OrderShipped($this->emailTpl,$this->address,$this->address_name));
            Log::channel('email_success')->info($this->user->email.':'.$this->emailTpl->name.':发送成功');
        }catch (\Exception $exception){
            Log::channel('email_error')->error($this->user->email.':'.$this->emailTpl->name,[$exception->getMessage()]);
        }

    }
}
