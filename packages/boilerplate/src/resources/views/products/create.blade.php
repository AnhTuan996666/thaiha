@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::products.title'),
    'subtitle' => __('boilerplate::products.create.title'),
    'breadcrumb' => [
        __('boilerplate::products.title') => 'boilerplate.products.index',
        __('boilerplate::products.create.title')
    ]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.products.create.post', 'autocomplete' => 'off']) }}
        <div class="row justify-content-center">
            <div class="col-12 pb-3">
                <a href="{{ route('boilerplate.products.index') }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::products.returntolist')">
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
            <div class="col-lg-12">
                    @component('boilerplate::card', ['title' => 'boilerplate::products.informations'])
                        <div class="w-50 mx-auto">
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::products.name', 'autofocus' => true])@endcomponent
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::products.slug'])@endcomponent
                                </div>
                            </div>
                            @component('boilerplate::input', ['name' => 'description','type' => 'textarea','rows' => '4', 'label' => 'boilerplate::products.description'])@endcomponent
                            @component('boilerplate::input', ['name' => 'image_path','type' => 'file', 'label' => 'boilerplate::products.image'])@endcomponent
                        </div>
                    @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection