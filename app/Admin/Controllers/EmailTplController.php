<?php

namespace App\Admin\Controllers;

use App\EmailCorn;
use App\EmailTpl;
use App\Mail\OrderShipped;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmailTplController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmailTpl';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailTpl());

        $grid->column('id', __('Id'));
        $grid->column('name', __('名称'));

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
        $EmailTpl =EmailTpl::findOrFail($id);



        return new OrderShipped($EmailTpl,EmailCorn::first());
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmailTpl());

        $form->text('name', __('Name'));
        $form->textarea('desc', __('Desc'));

        return $form;
    }
}
