@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::articles.title'),
    'subtitle' => __('boilerplate::articles.list.title'),
    'breadcrumb' => [
        __('boilerplate::articles.title') => 'boilerplate.articles.index'
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route('boilerplate.articles.create') }}" class="btn btn-primary">
                    @lang('boilerplate::articles.create.title')
                </a>
            </span>
        </div>
    </div>
    @component('boilerplate::card')
        @component('boilerplate::datatable', ['name' => 'articles']) @endcomponent
    @endcomponent
@endsection

@push('css')
    <style>.img-circle { border:1px solid #CCC }</style>
@endpush
