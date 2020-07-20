<?php

namespace App\Admin\Actions\User;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class ImportPost extends Action
{
    protected $selector = '.import-post';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->success('下载成功')->download('/excel/moban.xlsx');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post">下载实例导入模板</a>
HTML;
    }
}
