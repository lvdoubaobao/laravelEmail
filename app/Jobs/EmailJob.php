<?php

namespace App\Jobs;

use App\EmailCorn;
use App\EmailTpl;
use App\Reoisitory\MailGunRespository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public  $emailTpl;
    public  $emailCorn;
    /**
     * 任务可尝试的次数
     *
     * @var int
     */
    public $tries = 1;
    /**
     * 在超时之前任务可以运行的秒数
     *
     * @var int
     */
    public $timeout = 120;
    /**
     * 任务失败前允许的最大异常数
     *
     * @var int
     */
    public $maxExceptions = 1;
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
                Redis::throttle(config('app.name'))->allow(1)->every(3)->then(function () {
                    // 任务逻辑...
                    /**
                     * @var MailGunRespository $mailGun
                     */
      /*         $mailGun=     app('mailgun');
               if ($this->emailCorn->address){
                   $mailGun->from($this->emailCorn->address);
               }
                if ($this->emailCorn->address_name){
                    $mailGun->formName($this->emailCorn->address);
                }
                $mailGun->to($this->user->email);
                $mailGun->send($this->emailCorn->name,$this->emailTpl->desc);
*/
                   \Illuminate\Support\Facades\Mail::to($this->user)->send(new \App\Mail\OrderShipped($this->emailTpl,$this->emailCorn,$this->user));
                    Log::channel('email_success')->info($this->user->email.':'.$this->emailTpl->name.':发送成功');
                }, function () {
                    // 无法获得锁...
                    return $this->release(3);
                });
    }
    public function  failed(\Exception $exception){
        Log::channel('email_error')->error($this->user->email.':'.$this->emailTpl->name,[$exception->getMessage()]);

    }
}
