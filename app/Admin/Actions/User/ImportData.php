<?php

namespace App\Admin\Actions\User;

use App\Imports\UsersImport;
use App\UserTag;
use Encore\Admin\Actions\Action;
use Encore\Admin\Admin;
use Illuminate\Http\Request;
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
        $tag=$request->input('tag');
        Excel::import(new UsersImport($tag),$file);

        return $this->response()->success('Success message...')->refresh();
    }
    public function form()
    {
        $this->select('tag','标签')->options(UserTag::all()->pluck('name','id'))->required();
        $this->file('file', '上传excel文件')->required();

    }

    protected function addScript()
    {

        if (!is_null($this->interactor)) {
            return $this->interactor->addScript();
        }

        $parameters = json_encode($this->parameters());

        $script = <<<SCRIPT

(function ($) {
    $('{$this->selector($this->selectorPrefix)}').off('{$this->event}').on('{$this->event}', function() {
        var data = $(this).data();
        var target = $(this);
        Object.assign(data, {$parameters});
        {$this->actionScript()}

        {$this->buildActionPromise1()}
        {$this->handleActionPromise()}
    });
})(jQuery);

SCRIPT;

        Admin::script($script);
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success import-data">导入客户</a>
HTML;
    }
}
