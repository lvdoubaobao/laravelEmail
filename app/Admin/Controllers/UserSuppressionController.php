<?php

namespace App\Admin\Controllers;

use App\UserSuppression;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserSuppressionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '错误邮箱列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserSuppression());
        $grid->model()->orderBy('id','desc');
        $grid->column('id', __('Id'));
        $grid->column('type', __('类型'))->using(UserSuppression::$typeMap);
        $grid->column('address', __('邮件'));
        $grid->column('reason', __('原因'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->filter(function (Grid\Filter $filter){
            $filter->like('address','邮件');
            $filter->in('type','类型')->multipleSelect(UserSuppression::$typeMap);
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
        $show = new Show(UserSuppression::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('address', __('Address'));
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
        $form = new Form(new UserSuppression());

        $form->number('type', __('Type'));
        $form->text('address', __('Address'));
        $form->textarea('reason', __('Reason'));

        return $form;
    }
}
