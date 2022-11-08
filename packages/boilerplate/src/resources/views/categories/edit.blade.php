@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::categories.title'),
    'subtitle' => __('boilerplate::categories.edit.title'),
    'breadcrumb' => [
        __('boilerplate::categories.title') => 'boilerplate.categories.index',
        __('boilerplate::categories.edit.title')
    ]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.categories.update', $categories->id], 'method' => 'put', 'autocomplete' => 'off']) }}
        <div class="row">
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
            <div class="col-12 ">
                @component('boilerplate::card')
                    <div class="w-50 mx-auto">
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::categories.name', 'value' => $categories->name])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::categories.slug', 'value' => $categories->slug])@endcomponent
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection