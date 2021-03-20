<?php

namespace App\Admin\Actions\Ringcentral;

use App\Reoisitory\RingcentralReoisitory;
use App\RingCenter;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TplJiance extends RowAction
{
    public $name = '检测是否正常';

    public function handle(Model $model,Request $request)
    {
        // $model ...
        // 获取到表单中的`type`值
        $phone=  $request->get('phone');
        $ringCenter=RingCenter::findOrFail($request->get('zhanghao'));
        $repos= new RingcentralReoisitory($ringCenter);
        $res=$repos->sendSms($phone,$model);
        if ($res['code']==0){

            return $this->response()->error($res['message'])->refresh();
        }else{

            return $this->response()->success($res['message'])->refresh();
        }

    }

    public function form()
    {
        $this->text('phone','手机号')->required()->default(13153384851);
        $this->select('zhanghao','选择账户')->options(RingCenter::whereIsDisplay(1)->get()->pluck('name','id'))->required();
    }
}
