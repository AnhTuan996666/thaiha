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
        $userModel = config('boilerplate.auth.providers.product.model');

        return $userModel::with('roles')->select([
            'product.id',
            'email',
            'last_name',
            'first_name',
            'active',
            'product.created_at',
            'last_login',
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
            Column::add()
                ->width('40px')
                ->notSearchable()
                ->notOrderable()
                ->data('avatar', function ($user) {
                    return '<img src="'.$user->avatar_url.'" class="img-circle" width="32" height="32" />';
                }),

            Column::add(__('boilerplate::product.list.state'))
                ->width('100px')
                ->data('active', function ($user) {
                    $badge = '<span class="badge badge-pill badge-%s">%s</span>';
                    if ($user->active == 1) {
                        return sprintf($badge, 'success', __('boilerplate::product.active'));
                    }

                    return sprintf($badge, 'danger', __('boilerplate::product.inactive'));
                })
                ->filterOptions([__('boilerplate::product.inactive'), __('boilerplate::product.active')]),

            Column::add(__('jjjjj'))
                ->width('12%')
                ->data('last_name'),

            Column::add(__('First name'))
                ->width('12%')
                ->data('first_name'),

            Column::add(__('Email'))
                ->width('12%')
                ->data('email'),

            Column::add(__('boilerplate::product.list.roles'))
                ->notOrderable()
                ->filter(function ($query, $q) {
                    $query->whereHas('roles', function (Builder $query) use ($q) {
                        $query->where('name', '=', $q);
                    });
                })
                ->data('roles', function ($user) {
                    return $user->roles->implode('display_name', ', ') ?: '-';
                })
                ->filterOptions(function () {
                    $roleModel = config('boilerplate.laratrust.role');

                    return $roleModel::all()->pluck('display_name', 'name')->toArray();
                }),

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('product.created_at')
                ->dateFormat(),

            Column::add(__('boilerplate::product.list.lastconnect'))
                ->width('12%')
                ->data('last_login')
                ->fromNow(),

            Column::add()
                ->width('70px')
                ->actions(function ($user) {
                    $currentUser = Auth::user();

                    $buttons = Button::edit('boilerplate.product.edit', $user->id);

                    if (($currentUser->hasRole('admin') || ! $user->hasRole('admin')) && $user->id !== $currentUser->id) {
                        $buttons .= Button::delete('boilerplate.product.destroy', $user->id);
                    }

                    return $buttons;
                }),
        ];
    }
}
