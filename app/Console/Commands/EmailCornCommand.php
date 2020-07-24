<?php

namespace App\Console\Commands;

use App\EmailCorn;
use App\EmailTpl;
use App\Jobs\EmailJob;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class EmailCornCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:corn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时发送计划任务';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        EmailCorn::whereIsSend(0)->where('time','<',Carbon::now())->chunkById(100,function ($items){
            foreach ($items as $item){
               //查询出模板
              $email= EmailTpl::find($item->tpl_id);
              User::whereTagId($item->tag_id)->chunkById(100,function ($users)use($email,$item){
                  foreach ($users as $user){
                    dispatch(new EmailJob($user, $email,$item));
                  }
              });
              $item->is_send=1;
              $item->save();
            }
        });
    }

}
