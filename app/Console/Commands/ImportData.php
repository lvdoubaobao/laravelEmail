<?php

namespace App\Console\Commands;

use App\Import;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Console\Command;

use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Contracts\Sheet as SheetInterface;
use Dcat\EasyExcel\Support\SheetCollection;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入数据定时任务';

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
        ini_set('memory_limit', '-1');
        $this->info($this->convertSize(memory_get_usage()));
        Import::where('is_send', 0)->chunk(1, function ($items) {
            foreach ($items as $item) {
                /**
                 * @var Import $item
                 */

                    $this->output->title('Starting import');
                    $num=0;



                    Excel::import(storage_path('app/' . $item->name))->each(function (SheetInterface $sheet) use ($item,$num) {

                        // 每100行数据为一批数据进行读取
                        $chunkSize = 100;

                        $sheet->chunk($chunkSize, function (SheetCollection $collection) use ($item,$num) {

                            $this->info($this->convertSize(memory_get_usage()));

                            // 此处的数组下标依然是excel表中数据行的行号
                            $collection = $collection->toArray();

                            foreach ($collection as $row) {
                                try {

                                $user = User::where('phone', (string)$row['phone'])->where('tag_id', $item->tag_id)->first();
                            }catch (\Exception $exception ){
                                $this->error($exception->getMessage());
                                dd($row);
                            }
                                if (!$user && $row['phone']) {
                                    $user = new User();
                                    $user->name = $row['name'] ?? '';
                                    $user->email = $row['email'] ?? '';
                                    $user->phone = $row['phone'] ?? '';
                                    $user->country = $row['country'] ?? '';
                                    $user->province = $row['province'] ?? '';
                                    $user->password = bcrypt('123456');
                                    $user->city = $row['city'] ?? '';
                                    $user->tag_id = $item->tag_id;
                                    $user->since = $row['since'] ?? '';
                                    $user->admin_id = $item->admin_id;
                                    $user->save();
                                    $this->info($num++);

                                }else{
                                    $this->info($num++);
                                }
                            }
                        });
                    });

                    $item->is_send = 1;
                    $item->save();
                    $this->info($item->name);
                    $this->output->success('Import successful');
                    \Log::info('完成');

            }
        });

    }
    function convertSize($size){
        $unit=array('byte','kb','mb','gb','tb','pb');
        return round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}
