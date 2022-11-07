<?php

namespace Sebastienheyd\Boilerplate\Datatables\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class ProductDatatable extends Datatable
{
    public $slug = 'product';

    public function datasource()
    {
        $productModel = config('boilerplate.auth.providers.product.model');

        return $productModel::with('roles')->select([
            'product.id',
            'name',
            'slug',
            'image_patd',
            'description',
            'product.created_at',
        ]);
    }

    public function setUp()
    {
        $this->permissions('product_crud')
            ->locale([
                'deleteConfirm' => __('boilerplate::product.list.confirmdelete'),
                'deleteSuccess' => __('boilerplate::product.list.deletesuccess'),
            ])->order('created_at', 'desc')->stateSave();
    }

    public function columns(): array
    {
        return [
            Column::add(__('id'))
                ->width('12%')
                ->data('id'),

            Column::add(__('Name'))
                ->width('12%')
                ->data('name'),

            Column::add(__('Slug'))
                ->width('12%')
                ->data('slug'),

            Column::add(__('Image'))
            ->width('40px')
            ->notSearchable()
            ->notOrderable()
            ->data('avatar', function ($product) {
                return '<img src="'.$product->avatar_url.'" class="img-circle" width="32" height="32" />';
            }),

            Column::add(__('Description'))
                ->width('12%')
                ->data('description'),

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('product.created_at')
                ->dateFormat(),

            Column::add(__(''))
                ->width('70px')
                ->actions(function ($product) {

                    $buttons = Button::edit('boilerplate.product.edit', $product->id);

                    $buttons .= Button::delete('boilerplate.product.destroy', $product->id);

                    return $buttons;
                }),
        ];
    }
}
