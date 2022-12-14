@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::articles.title'),
    'subtitle' => __('boilerplate::articles.create.title'),
    'breadcrumb' => [
        __('boilerplate::articles.title') => 'boilerplate.articles.index',
        __('boilerplate::articles.create.title')
    ]
])
@include('boilerplate::load.fileinput')
@section('content')
    {{ Form::open(['route' => 'boilerplate.articles.createPost', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
        <div class="row justify-content-center">
            <div class="col-12 pb-3">
                <a href="{{ route('boilerplate.articles.index') }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::articles.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::articles.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    @component('boilerplate::card', ['title' => 'boilerplate::articles.informations'])
                        <div class="w-50 mx-auto">
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'title', 'label' => 'boilerplate::articles.name','id' => 'title','onkeyup' => 'ChangeToSlug()', 'autofocus' => true])@endcomponent
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'slug','id' => 'slug', 'label' => 'boilerplate::articles.slug'])@endcomponent
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-12">
                                        @component('boilerplate::input', ['name' => 'excerpt', 'label' => 'boilerplate::articles.excerpt','id' => 'summary-ckeditor'])@endcomponent
                                    </div>
                                </div>
                            @component('boilerplate::input', ['name' => 'body','type' => 'textarea','rows' => '4', 'id' => 'summary-ckeditor-one', 'label' => 'boilerplate::articles.description'])@endcomponent
                            @component('boilerplate::input', ['name' => 'image_path','onchange'=>'previewFile(this)','type' => 'file', 'id'=>'files' , 'label' => 'boilerplate::articles.image'])@endcomponent
                            <img id="previewImg" src="" alt="Ảnh minh họa" width="100" height="100">
                        </div>
                    @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection