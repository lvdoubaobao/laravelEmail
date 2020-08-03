<?php

namespace App\Console\Commands;

use App\UserSuppression;
use Illuminate\Console\Command;
use Mailgun\Model\Suppression\Bounce\Bounce;
use Mailgun\Model\Suppression\Complaint\Complaint;
use Mailgun\Model\Suppression\Unsubscribe\Unsubscribe;

class UserSuppressionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:send {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时检测';

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
        $type = $this->argument('type');
        switch ($type){
            case UserSuppression::bounces :
                $mgClient=   \Mailgun\Mailgun::create(config('services.mailgun.secret'))->suppressions()->bounces();
                break;
            case UserSuppression::unsubscribes :
                $mgClient=   \Mailgun\Mailgun::create(config('services.mailgun.secret'))->suppressions()->unsubscribes();
                break;
            case UserSuppression::complaints :
                $mgClient=   \Mailgun\Mailgun::create(config('services.mailgun.secret'))->suppressions()->complaints();
                break;
        }
        $result=   $mgClient->index(config('services.mailgun.domain'));;
        $this->create(
            $result->getItems()
        );
        while ($result->getNextUrl()!=$result->getLastUrl()){
            $result= $mgClient->nextPage($result);
            $this->create(
                $result->getItems()
            );
        }
    }
    public function create($items){
            foreach ($items as $item){


                $userSuppression= UserSuppression::whereAddress($item->getAddress())->first();
                if(!$userSuppression){
                    $userSuppression=new UserSuppression();
                    $userSuppression->address=$item->getAddress();
                    $userSuppression->type=$this->argument('type');
                    if ($item instanceof  Bounce){
                        /**
                         * @var Bounce $item
                         */
                        $userSuppression->reason=$item->getError();
                    }elseif ($item instanceof  Unsubscribe){
                        /**
                         * @var Unsubscribe $item
                         */

                    }elseif ($item instanceof  Complaint){
                        /**
                         * @var Complaint $item
                         */
                    }
                    $userSuppression->save();
                    $this->info($userSuppression->toJson());
                }
            }
    }
}
