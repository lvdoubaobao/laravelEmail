<?php

namespace App\Admin\Controllers;

use App\EmailCorn;
use App\EmailTpl;
use App\UserTag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmailCornController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '发送计划';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailCorn());

        $grid->column('id', __('Id'));
        $grid->column('name', __('名称'));
        $grid->column('tpl_id', __('邮箱模板'))->display(function ($value){
            return EmailTpl::find($value)->name ?? '';
        });
        $grid->column('tag_id', __('标签'))->display(function ($value){
            return UserTag::find($value)->name ?? '';
        });
        $grid->column('time', __('发送时间'));
        $grid->column('is_send', __('是否发送'))->display(function ($value){
            return $value==0 ? '未发送' : '已发送';
        })->label([
            0=>'warning',
            1=>'success'
        ]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(EmailCorn::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('tpl_id', __('Tpl id'));
        $show->field('tag_id', __('Tag id'));
        $show->field('time', __('Time'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('is_send', __('Is send'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmailCorn());

        $form->text('name', __('名称'))->required();
        $form->email('address', __('发送者邮箱地址'))->help('不填为默认');
        $form->text('address_name', __('发送者邮箱名称'))->help('不填为默认');
        $form->select('tpl_id', __('模板id'))->options(EmailTpl::all()->pluck('name','id'))->required();
        $form->select('tag_id', __('标签'))->options(UserTag::all()->pluck('name','id'))->required();
        $form->datetime('time', __('发送时间'))->default(date('Y-m-d H:i:s'))->required();
        return $form;
    }
}
