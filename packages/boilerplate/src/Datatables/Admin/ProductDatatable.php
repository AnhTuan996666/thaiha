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
        return \DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as cName');
    }

    public function columns(): array
    {
        return [
            Column::add(__('id'))
                ->width('12%')
                ->data('id'),
            
            Column::add(__('Category Name'))
                ->width('12%')
                ->data('cName'),
            
            Column::add(__('Name'))
                ->width('12%')
                ->data('name'),

            Column::add(__('Slug'))
                ->width('12%')
                ->data('slug'),

            Column::add(__('Image'))
            ->width('50px')
            ->notSearchable()
            ->notOrderable()
            ->data('image_path', function ($product) {
                return '<img src="'.asset('uploads/'.$product->image_path).'" class="img-circle" width="50" height="50" />';
            }),

            Column::add(__('Description'))
                ->width('12%')
                ->data('description', function($product) {
                    return html_entity_decode($product->description);   
                }),

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('created_at')
                ->dateFormat(),

            Column::add(__('Updated at'))
                ->width('12%')
                ->data('updated_at')
                ->name('updated_at')
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
