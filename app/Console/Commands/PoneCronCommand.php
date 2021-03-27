<?php

namespace App\Console\Commands;

use App\PhoneBlacklist;
use App\PhoneCorn;
use App\PhoneTpl;
use App\Reoisitory\RingcentralReoisitory;
use App\RingCenter;
use App\User;
use Illuminate\Console\Command;

class PoneCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:name {cron_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '单独的';

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
        $corn=PhoneCorn::where('is_send','!=',1)->where('id',$cron_id)->first();
        $corn->is_send = 2;
        $corn->save();
        $tpl = PhoneTpl::find($corn->phone_tpl_id);
        $user = User::whereTagId($corn->tag_id)->chunkById(100, function ($users) use ($tpl, $corn) {
            if ($corn->ringcenter->isNotEmpty()) {
                foreach ($corn->ringcenter as $item) {
                    /**
                     * @var  RingCenter $item
                     */
                    $ringcentralReoisitory[] = new RingcentralReoisitory($item);
                }
            }

            foreach ($users as $user) {
                /**
                 * @var User $user
                 */
                $PhoneCorn = PhoneCorn::find($corn->id);
                if ($PhoneCorn&&$PhoneCorn->is_stop == 1) {//暂停功能
                    break;
                }
                $black = PhoneBlacklist::wherePhone(substr($user->phone, -5))->first();
                if (!$black) {
                    $this->info($user->id);
                    $ringcentralReoisitory[array_rand($ringcentralReoisitory)]->sendSms($user, $tpl, $corn);

                }
            }
        });
        $PhoneCorn = PhoneCorn::find($corn->id);
        $this->info($PhoneCorn->is_stop);
        if ($PhoneCorn->is_stop!=1){
            $corn->is_send = 1;
            $corn->save();
        }
    }
}
