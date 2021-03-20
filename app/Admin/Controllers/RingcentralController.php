<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Ringcentral\Jiance;
use App\Reoisitory\RingcentralReoisitory;
use App\RingCenter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RingcentralController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RingCentral账户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RingCenter());
        $grid->model()->where('admin_id',\Admin::user()->id);
        $grid->column('id', __('Id'));
        $grid->column('real_name', __('名称'))->editable();
        $grid->column('name', __('账号'))->editable();
        $grid->column('password', __('密码'))->editable();
        $grid->column('ext','ext')->editable();
        $grid->column('is_display','状态')->display(function ($value){
                return $value ? '通过' :'未通过';
         })->label(
             [
                 'warning',
                 'success'
             ]
         );

        $grid->actions(function ($actions) {
            $actions->add(new Jiance());
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
        $show = new Show(RingCenter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('password', __('Password'));
        $show->field('created_at', __('Created at'));
        $show->field('update_at', __('Update at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RingCenter());
        $form->text('real_name', __('名称'))->required();
        $form->text('name', __('账号'))->required();

        $form->hidden('admin_id')->default(\Admin::user()->id);
        $form->password('password', __('密码'))->required();
        $form->text('ext','ext')->required();

        return $form;
    }
}
