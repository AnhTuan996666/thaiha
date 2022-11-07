@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::products.title'),
    'subtitle' => __('boilerplate::products.edit.title'),
    'breadcrumb' => [
        __('boilerplate::products.title') => 'boilerplate.products.index',
        __('boilerplate::products.edit.title')
    ]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.products.update', $product->id], 'method' => 'put', 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("boilerplate.products.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::products.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::products.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @component('boilerplate::card', ['title' => __('boilerplate::products.informations')])
                    <div class="row">
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::products.name', 'value' => $product->name])@endcomponent
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::products.slug', 'value' => $product->slug])@endcomponent
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection