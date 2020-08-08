<?php

namespace App\Admin\Actions\Ringcentral;

use App\Reoisitory\RingcentralReoisitory;
use App\RingCenter;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Jiance extends RowAction
{
    public $name = '检测是否正常';

    public function handle(Model $model,Request $request)
    {
        // $model ...
        // 获取到表单中的`type`值
      $phone=  $request->get('phone');

        // 获取表单中的`reason`值
        $desc=   $request->get('desc');
        $repos= new RingcentralReoisitory($model);
        $res=$repos->testPhone($phone,$desc);
        if ($res['code']==0){
            $model->is_display=0;
            $model->save();
            return $this->response()->error($res['message'])->refresh();
        }else{
            $model->is_display=1;
            $model->save();
            return $this->response()->success($res['message'])->refresh();
        }

    }

    public function form()
    {
        $this->text('phone','手机号')->required()->default(13153384851);
        $this->textarea('desc', '内容')->required()->default('test hello');
    }
}
