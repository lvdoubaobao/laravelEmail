<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class LockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        for ($i=0;$i<=1000;$i++){
            Redis::throttle('phone')->allow(3)->every(5)->then(function ()use ($i){
                $this->info($i);
                $this->info(Carbon::now()->toDateTimeString());
            },function (){
               sleep(3);
            });
        }

    }
}
