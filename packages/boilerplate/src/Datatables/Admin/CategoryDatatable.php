<?php

namespace Sebastienheyd\Boilerplate\Datatables\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class CategoryDatatable extends Datatable
{
    public $slug = 'categories';

    public function datasource()
    {
        return \DB::table('categories')->select([
            'id',
            'name',
            'slug',
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

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('created_at')
                ->dateFormat(),

            Column::add(__('Update at'))
                ->width('12%')
                ->data('updated_at')
                ->name('updated_at')
                ->dateFormat(),

            Column::add(__(''))
                ->width('70px')
                ->actions(function ($categorie) {

                    $buttons = Button::edit('boilerplate.categories.edit', $categorie->id);

                    $buttons .= Button::delete('boilerplate.categories.destroy', $categorie->id);

                    return $buttons;
                }),
        ];
    }
}
