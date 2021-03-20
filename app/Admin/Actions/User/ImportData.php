<?php

namespace App\Admin\Actions\User;

use App\Imports\UsersImport;
use App\Jobs\ImportJob;
use App\UserTag;
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
        $file=$request->file('file');
        $name= $file->storeAs('excel',$file->getClientOriginalName());

        $tag=$request->input('tag');
        $admin_id=$request->input('admin_id');
        dispatch(new ImportJob($tag,$name,$admin_id) );
        return $this->response()->success('已成功上传')->refresh();
    }
    public function form()
    {
        $this->select('tag','标签')->options(UserTag::where('admin_id',\Encore\Admin\Facades\Admin::user()->id)->get()->pluck('name','id'))->required();
        $this->file('file', '上传excel文件')->required();
        $this->hidden('admin_id',\Encore\Admin\Facades\Admin::user()->id);

    }
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success import-data">导入客户</a>
HTML;
    }
}
