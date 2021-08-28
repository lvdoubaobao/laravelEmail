<?php

namespace App\Admin\Actions\User;

use App\Import;
use App\Imports\UsersImport;
use App\Jobs\ImportJob;
use App\UserTag;
use Dcat\EasyExcel\Contracts\Sheet as SheetInterface;
use Dcat\EasyExcel\Support\SheetCollection;
use Encore\Admin\Actions\Action;
use Encore\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportData extends Action
{
    protected $selector = '.import-data';
    public $name = '导入客户';

    public function handle(Request $request)
    {
        set_time_limit(0);
        // $request ...
        $file = $request->file('file');
        $name = $file->storeAs('excel', $file->getClientOriginalName());
        $tag = $request->input('tag');
        $admin_id = $request->input('admin_id');
        \Dcat\EasyExcel\Excel::import(storage_path('app/' . $name))->each(function (SheetInterface $sheet)  {
            $chunkSize = 2;
            $sheet->chunk($chunkSize, function (SheetCollection $collection)  {
                    $row=$collection->toArray();
                    foreach ($row as $item){
                        if (!isset($item['phone'])){
                            throw  new \Exception('请选择正确的模板');
                        }
                    }

            });
        });
        $import = new Import();
        $import->admin_id = $admin_id;
        $import->tag_id = $tag;
        $import->name = $name;
        $import->save();
        return $this->response()->success('已成功上传,请过几分钟查看客户')->refresh();
    }

    public function form()
    {
        $this->select('tag', '标签')->options(UserTag::where('admin_id', \Encore\Admin\Facades\Admin::user()->id)->get()->pluck('name', 'id'))->required();
        $this->file('file', '上传excel文件')->required();
        $this->hidden('admin_id')->default(\Encore\Admin\Facades\Admin::user()->id);
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success import-data">导入客户</a>
HTML;
    }
}
