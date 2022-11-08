@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::categories.title'),
    'subtitle' => __('boilerplate::categories.list.title'),
    'breadcrumb' => [
        __('boilerplate::categories.title') => 'boilerplate.categories.index'
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route('boilerplate.categories.create') }}" class="btn btn-primary">
                    @lang('boilerplate::categories.create.title')
                </a>
            </span>
        </div>
    </div>
    @component('boilerplate::card')
        @component('boilerplate::datatable', ['name' => 'categories']) @endcomponent
    @endcomponent
@endsection

@push('css')
    <style>.img-circle { border:1px solid #CCC }</style>
@endpush
