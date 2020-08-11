<?php

namespace App\Console\Commands;

use App\RingCenter;
use Illuminate\Console\Command;

class PhoneHuihuaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'huihua';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '拉取会话';

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
        RingCenter::whereIsDisplay(1)->get()->map(function ($item){
            $aa=  new \App\Reoisitory\RingcentralReoisitory($item);
            $aa->blackList();
        });
    }
}
