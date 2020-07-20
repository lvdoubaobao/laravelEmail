<?php

namespace App\Admin\Actions\User;

use App\Imports\UsersImport;
use App\UserTag;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportData extends Action
{
    protected $selector = '.import-data';
    public $name = '导入客户';
    public function handle(Request $request)
    {
        // $request ...
        $file=$request->file('file');
        $tag=$request->input('tag');
        Excel::import(new UsersImport($tag),$file);
        return $this->response()->success('Success message...')->refresh();
    }
    public function form()
    {
        $this->select('tag','标签')->options(UserTag::all()->pluck('name','id'))->required();
        $this->file('file', '上传excel文件')->required();

    }
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success import-data">导入客户</a>
HTML;
    }
}
