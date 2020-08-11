<?php

namespace App\Console\Commands;

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
    protected $signature = 'Fail:phone';

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

        PhoneLog::whereStatus(0)->chunkById(100,function ($items){
                foreach ($items as $item){
                    $ringcentralReoisitory=new RingcentralReoisitory(RingCenter::findOrFail(1));
                    /**
                     * @var PhoneLog $item
                     */
                    $ringcentralReoisitory->sendSms(User::wherePhone($item->phone)->first(),PhoneTpl::find(2));
                    $item->status=1;
                    $item->save();
                    sleep(3);

                }
        });
    }
}
