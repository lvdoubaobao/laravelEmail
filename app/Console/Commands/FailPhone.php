<?php

namespace App\Console\Commands;

use App\PhoneCorn;
use App\PhoneLog;
use App\PhoneTpl;
use App\Reoisitory\RingcentralReoisitory;
use App\RingCenter;
use App\User;
use Illuminate\Console\Command;

class FailPhone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Fail:phone {cron_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重发失败得手机号';

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
        $cron_id=$this->argument('cron_id');
        PhoneLog::whereStatus(0)->where('tpl_id',$cron_id)->chunkById(100,function ($items){
                foreach ($items as $item){
                    $phoneCorn=     PhoneCorn::find($item->tpl_id);
                    if ($phoneCorn->ringcenter->isNotEmpty()) {
                        foreach ($phoneCorn->ringcenter as $item1) {
                            /**
                             * @var  RingCenter $item1
                             */
                            $ringcentralReoisitory = new RingcentralReoisitory($item1);
                        }
                    }
                    $this->info($item->id);
                    /**
                     * @var PhoneLog $item
                     */
                    $ringcentralReoisitory->sendSms(User::wherePhone($item->phone)->first(),PhoneTpl::find($phoneCorn->phone_tpl_id),$phoneCorn);
                    $item->status=1;
                    $this->info($item->phone);
                    $item->save();


                }
        });
    }
}
