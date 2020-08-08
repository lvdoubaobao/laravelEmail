<?php


namespace App\Admin\Selectable;


use App\Ringcenter;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class RingCenterAble extends  Selectable
{
    public $model = Ringcenter::class;

    public function make()
    {
        $this->model()->where('is_display',1);
        $this->column('id');
        $this->column('real_name','名称');
        $this->column('name','账号');
        $this->column('created_at');

        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
