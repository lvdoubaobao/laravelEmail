<?php

namespace App\Console\Commands;

use App\PhoneBlacklist;
use App\PhoneHuihua;
use Illuminate\Console\Command;
use function GuzzleHttp\Psr7\str;

class BlackList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blackList';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '手机黑名单';

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
        PhoneHuihua::chunkById(50,function (  $items){
            foreach ($items as $item){
                $this->info($item->id);
            $subject=strtolower($item->subject);
            if (strstr($subject,'stop')){
             $phoneBlack=   PhoneBlacklist::wherePhone(substr($item->from['phoneNumber'],-5))->first();
             if (!$phoneBlack){
                 $phone=new PhoneBlacklist();
                 $phone->phone=substr($item->from['phoneNumber'],-5);
                 $phone->save();
             }
            }
            }
        });
    }
}
