<?php

namespace App\Console\Commands;

use App\PhoneCorn;
use App\PhoneTpl;
use App\Reoisitory\RingcentralReoisitory;
use App\Ringcenter;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class PhoneSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phone:corn';
    protected  $ringcentralReoisitory;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '短信定时发送';

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
        PhoneCorn::where('is_send',0)->where('send_time','<',Carbon::now())->chunkById(10,function ($Corns){
                foreach ($Corns as $corn){
                            $ringcentralReoisitory=[];
                            /**
                             * @var  PhoneCorn $corn
                             */
                          //  $corn

                             if ($corn->ringcenter->isNotEmpty()){
                                 foreach ($corn->ringcenter as $item){
                                     /**
                                      * @var  Ringcenter $item
                                      */
                                     $ringcentralReoisitory[]=new RingcentralReoisitory($item);
                                 }
                             }

                             $tpl=PhoneTpl::find($corn->phone_tpl_id);
                              $user= User::whereTagId($corn->tag_id)->chunkById(10,function ($users)use($tpl,$ringcentralReoisitory){
                                  foreach ($users as $user){
                                      /**
                                       * @var User  $user
                                       */
                                      Redis::throttle('phoneCorn')->allow(10)->every(60)->then(function ()use($user,$tpl,$ringcentralReoisitory){
                                        $ringcentralReoisitory[array_rand($ringcentralReoisitory)]->sendSms($user,$tpl);
                                      });
                                  }
                              });
                           $corn->is_send=1;
                           $corn->save();
                }
        });
    }
}
