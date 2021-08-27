<?php

namespace App\Console\Commands;

use App\Import;
use App\Imports\UsersImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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
        Import::where('is_send',0)->chunk(1,function ($items){
            foreach ($items as $item){
                /**
                 * @var Import $item
                 */
                try {
                    $this->output->title('Starting import');
                    Excel::import((new UsersImport($item->tag_id,$item->admin_id))->withOutput($this->output),storage_path('app/'.$item->name));
                    $item->is_send=1;
                    $item->save();
                    $this->info($item->name);
                    $this->output->success('Import successful');
                    \Log::info('完成');
                }catch (ValidationException $exception){
                    $failures = $exception->failures();
                    foreach ($failures as $failure) {
                        $failure->row(); // row that went wrong
                        $failure->attribute(); // either heading key (if using heading row concern) or column index
                        $failure->errors(); // Actual error messages from Laravel validator
                        $failure->values(); // The values of the row that has failed.
                    }
                } catch (\Exception $exception){
                    \Log::info('excel出错',[$exception->getMessage()]);
                }
            }
        });

    }
}
