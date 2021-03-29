<?php

namespace App\Admin\Controllers;

use App\Import;
use App\UserTag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use function Clue\StreamFilter\fun;

class ImportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '导入列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Import());
        $grid->model()->where('admin_id',Admin::user()->id)->orderBy('id','desc');
        $grid->column('name','excel');
        $grid->column('tag_id','标签')->display(function ($value){
            return UserTag::find($value)->name ?? '';
        });
        $grid->column('created_at','创建时间');
        $grid->column('is_send', __('是否完成'))->display(function ($value){
            return $value==1 ? '完成' :' 未完成';
        });
        $grid->disableExport();
        $grid->disableActions();
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
        $show = new Show(Import::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tag_id', __('Tag id'));
        $show->field('admin_id', __('Admin id'));
        $show->field('name', __('Name'));
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
        $form = new Form(new Import());

        $form->number('tag_id', __('Tag id'));
        $form->number('admin_id', __('Admin id'));
        $form->text('name', __('Name'));
        $form->number('is_send', __('Is send'));

        return $form;
    }
}
