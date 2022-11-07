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
            <div class="col-lg-6">
                @component('boilerplate::card', ['title' => 'boilerplate::products.informations'])
                    @component('boilerplate::select2', ['name' => 'active', 'label' => 'boilerplate::products.status', 'minimum-results-for-search' => '-1'])
                        <option value="1" @if (old('active', 1) == "1") selected="selected" @endif>@lang('boilerplate::products.active')</option>
                        <option value="0" @if (old('active') == "0") selected="selected" @endif>@lang('boilerplate::products.inactive')</option>
                    @endcomponent
                    <div class="row">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::products.firstname', 'autofocus' => true])@endcomponent
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::products.lastname'])@endcomponent
                        </div>
                    </div>
                    @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::products.email'])@endcomponent
                @endcomponent
            </div>
            <div class="col-lg-6">
                @component('boilerplate::card', ['title' => 'boilerplate::products.informations'])
                    <div class="row">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::products.firstname', 'autofocus' => true])@endcomponent
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::products.lastname'])@endcomponent
                        </div>
                    </div>
                    @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::products.email'])@endcomponent
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection