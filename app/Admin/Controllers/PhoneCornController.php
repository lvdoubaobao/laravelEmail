<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\RingCenterAble;
use App\PhoneCorn;
use App\PhoneTpl;
use App\UserTag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhoneCornController extends AdminController
{
    protected  $states = [
        'on'  => ['value' => 0, 'text' => '不停止', 'color' => 'primary'],
        'off' => ['value' => 1, 'text' => '停止', 'color' => 'default'],
    ];
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '短信发送计划';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhoneCorn());
        $grid->model()->where('admin_id',\Admin::user()->id);
        $grid->column('id', __('Id'));
        $grid->column('phone_tpl_id', __('模板'))->display(function ($value){
            return PhoneTpl::find($value)->name ?? '';
        });
        $grid->column('tag_id', __('标签'))->display(function($value){
            return UserTag::find($value)->name ?? '';
        });
        $grid->column('is_stop','是否停止')->switch($this->states);
        $grid->column('number','发送数量');
        $grid->column('send_time', __('发送时间'));
        $grid->column('is_send', __('是否发送'))->display(function ($value){
            if ($value==0){
                return '未发送';
            }elseif ($value==1){
                return '已发送';
            }elseif ($value==2){
                return '正在发送';
            }
        })->label([
            0=>'warning',
            1=>'success',
            2=>'success'
        ]);
        $grid->column('created_at', __('创建时间'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(PhoneCorn::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('phone_tpl_id', __('Phone tpl id'));
        $show->field('send_time', __('Send time'));
        $show->field('is_send', __('Is send'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('tag_id', __('Tag id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PhoneCorn());

        $form->text('name','名称')->required();
        $form->select('phone_tpl_id', __('手机模板'))->options(PhoneTpl::where('admin_id',Admin::user()->id)->get()->pluck('name','id'))->required();
        $form->datetime('send_time', __('发送时间'))->default(date('Y-m-d H:i:s'));
        $form->hidden('admin_id')->default(\Admin::user()->id);
        $form->select('tag_id', __('标签'))->options(UserTag::where('admin_id',Admin::user()->id)->get()->pluck('name','id'))->required();;
        $form->belongsToMany('ringcenter',RingCenterAble::class,'选择发送账号')->required();
        $form->switch('is_stop','是否停止')->states($this->states);
        return $form;
    }
}
