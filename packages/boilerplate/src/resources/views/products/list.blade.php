@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::products.title'),
    'subtitle' => __('boilerplate::products.list.title'),
    'breadcrumb' => [
        __('boilerplate::products.title') => 'boilerplate.products.index'
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route('boilerplate.products.create') }}" class="btn btn-primary">
                    @lang('boilerplate::products.create.title')
                </a>
            </span>
        </div>
    </div>
    @component('boilerplate::card')
        @component('boilerplate::datatable', ['name' => 'products']) @endcomponent
    @endcomponent
@endsection

@push('css')
    <style>.img-circle { border:1px solid #CCC }</style>
@endpush
