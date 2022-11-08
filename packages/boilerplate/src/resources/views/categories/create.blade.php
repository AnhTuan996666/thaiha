@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::categories.title'),
    'subtitle' => __('boilerplate::categories.create.title'),
    'breadcrumb' => [
        __('boilerplate::categories.title') => 'boilerplate.categories.index',
        __('boilerplate::categories.create.title')
    ]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.categories.create.post', 'autocomplete' => 'off']) }}
        <div class="row justify-content-center">
            <div class="col-12 pb-3">
                <a href="{{ route('boilerplate.categories.index') }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::categories.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::categories.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    @component('boilerplate::card', ['title' => 'boilerplate::categories.create.title'])
                        <div class="w-50 mx-auto">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::categories.name', 'autofocus' => true])@endcomponent
                                </div>
                                <div class="col-md-6 col-lg-12">
                                    @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::categories.slug'])@endcomponent
                                </div>
                            </div>
                        </div>
                    @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection