<?php

namespace Sebastienheyd\Boilerplate\Datatables\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class ArticleDatatable extends Datatable
{
    public $slug = 'articles';

    public function datasource()
    {
        return \DB::table('articles')->select([
            'id',
            'title',
            'slug',
            'body',
            'excerpt',
            'image_path',
            'created_at',
            'updated_at'
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
                ->data('title'),

            Column::add(__('Slug'))
                ->width('12%')
                ->data('slug'),

            Column::add(__('Excerpt'))
                ->width('12%')
                ->data('excerpt', function($article){
                return html_entity_decode($article->excerpt);
            }),
            
            Column::add(__('Description'))
                ->width('12%')
                ->data('body', function($article) {
                    return html_entity_decode($article->body);
                }),

            Column::add(__('Image'))
            ->width('50px')
            ->notSearchable()
            ->notOrderable()
            ->data('image_path', function ($article) {
                return '<img src="'.asset('img/'.$article->image_path).'" class="img-circle" width="50" height="50" />';
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
                ->actions(function ($article) {

                    $buttons = Button::edit('boilerplate.articles.edit', $article->id);

                    $buttons .= Button::delete('boilerplate.articles.destroy', $article->id);

                    return $buttons;
                }),
        ];
    }
}
