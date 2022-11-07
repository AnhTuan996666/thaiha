<?php

namespace Sebastienheyd\Boilerplate\Datatables\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class ProductDatatable extends Datatable
{
    public $slug = 'products';

    public function datasource()
    {
        return \DB::table('products')->select([
            'id',
            'name',
            'slug',
            'image_path',
            'description',
            'created_at',
        ]);
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
            ->data('image_path', function ($product) {
                return '<img src="'.$product->image_path.'" class="img-circle" width="32" height="32" />';
            }),

            Column::add(__('Description'))
                ->width('12%')
                ->data('description'),

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('created_at')
                ->dateFormat(),

            Column::add(__(''))
                ->width('70px')
                ->actions(function ($product) {

                    $buttons = Button::edit('boilerplate.products.edit', $product->id);

                    $buttons .= Button::delete('boilerplate.products.destroy', $product->id);

                    return $buttons;
                }),
        ];
    }
}
