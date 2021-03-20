<?php

namespace App\Admin\Controllers;

use App\PhoneLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhoneLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '短信发送日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhoneLog());

        $grid->column('id', __('Id'));
        $grid->column('phone', __('手机号'));
        $grid->column('status', __('状态'))->display(function ($value){
            return $value==1 ? '发送成功' : '发送失败';
        })->label([
            0=>'warning',
            1=>'success'
        ]);
        $grid->column('message', __('信息'));
        $grid->column('reason', __('失败原因'));
        $grid->column('created_at', __('创建时间'));
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions){
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });
        $grid->filter(function (Grid\Filter $filter){
            $filter->like('phone','手机号');
            $filter->in('status','状态')->select(['发送失败','发送成功']);
        });

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
        $show = new Show(PhoneLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('phone', __('Phone'));
        $show->field('message', __('Message'));
        $show->field('reason', __('Reason'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PhoneLog());

        $form->text('status', __('Status'));
        $form->mobile('phone', __('Phone'));
        $form->text('message', __('Message'));
        $form->textarea('reason', __('Reason'));

        return $form;
    }
}
