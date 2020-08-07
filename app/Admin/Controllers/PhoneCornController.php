<?php

namespace App\Admin\Controllers;

use App\PhoneCorn;
use App\PhoneTpl;
use App\UserTag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhoneCornController extends AdminController
{
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

        $grid->column('id', __('Id'));
        $grid->column('phone_tpl_id', __('模板'))->display(function ($value){
            return PhoneTpl::find($value)->name ?? '';
        });
        $grid->column('tag_id', __('标签'))->display(function($value){
            return UserTag::find($value)->name;
        });
        $grid->column('send_time', __('发送时间'));
        $grid->column('is_send', __('是否发送'))->display(function ($value){
            return $value==0 ? '未发送' : '已发送';
        });
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
        $form->select('phone_tpl_id', __('手机模板'))->options(PhoneTpl::all()->pluck('name','id'));
        $form->datetime('send_time', __('发送时间'))->default(date('Y-m-d H:i:s'));

        $form->select('tag_id', __('标签'))->options(UserTag::all()->pluck('name','id'))->required();;

        return $form;
    }
}
