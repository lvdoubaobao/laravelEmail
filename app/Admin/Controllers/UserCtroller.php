<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\User\ImportData;
use App\Admin\Actions\User\ImportPost;
use App\User;
use App\UserTag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserCtroller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '客户管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('姓名'));
        $grid->column('email', __('邮箱'));
        $grid->column('phone', __('手机号'));
        $grid->column('country', __('country'));
        $grid->column('province', __('province'));
        $grid->column('since', __('since'));
        $grid->column('tag_id', __('标签'))->display(function ($value){
            return UserTag::find($value)->name ?? '';
        });

        $grid->filter(function (Grid\Filter $filter){
            $filter->disableIdFilter();
            $filter->like('name','名称');
            $filter->like('email','邮箱');
            $filter->like('phone','手机号');
            $filter->like('country','country');
            $filter->like('province','province');
            $filter->like('since','since');
            $filter->in('tag_id','标签')->multipleSelect(UserTag::all()->pluck('name','id'));

        });
        $grid->column('created_at', __('创建时间'));
        if (!Admin::user()->can('customer.export')){
            $grid->disableExport();
        }
        $grid->tools(function (Grid\Tools $tools){

            $tools->append(new ImportData());
            $tools->append(new ImportPost());
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());
        $form->text('name', __('名称'));
        $form->text('email', __('邮箱'));
        $form->text('phone', __('手机号'));
        $form->text('country', __('country'));
        $form->text('province', __('province'));
        $form->text('since', __('since'));
        $form->select('tag_id', __('标签'))->options(
            UserTag::all()->pluck('name','id')
        );

        return $form;
    }
}
