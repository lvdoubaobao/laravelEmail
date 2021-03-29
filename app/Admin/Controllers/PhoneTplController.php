<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Ringcentral\Jiance;
use App\Admin\Actions\Ringcentral\TplJiance;
use App\PhoneTpl;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhoneTplController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '手机模板';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhoneTpl());
        if (Admin::user()->id!==1) {
            $grid->model()->where('admin_id', \Admin::user()->id);
        }
        $grid->column('id', __('Id'));
        $grid->column('name', __('名称'));
        $grid->column('tpl', __('模板消息'));

        $grid->column('created_at', __('创建时间'));

        $grid->column('admin_id','用户')->display(function ($value){
            return  Administrator::find($value)->username ?? '';
        });
        $grid->actions(function ($actions) {
            $actions->add(new TplJiance());
        });
        $grid->filter(function (Grid\Filter $filter){
            if (Admin::user()->id==1) {
                $filter->in('admin_id', '用户')->select(Administrator::get()->pluck('username', 'id'));
            }
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
        $show = new Show(PhoneTpl::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tpl', __('Tpl'));
        $show->field('name', __('Name'));
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
        $form = new Form(new PhoneTpl());
        $form->text('name', __('名称'))->required();
        $form->textarea('tpl', __('模板消息'))->help('用户变量用:{{name}}表示')->required();
        $form->multipleImage('image','多图上传')->removable()->sortable();
        $form->hidden('admin_id')->default(\Admin::user()->id);
        return $form;
    }
}
