@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::articles.title'),
    'subtitle' => __('boilerplate::articles.edit.title'),
    'breadcrumb' => [
        __('boilerplate::articles.title') => 'boilerplate.articles.index',
        __('boilerplate::articles.edit.title')
    ]
])
@include('boilerplate::load.fileinput')
@include('boilerplate::load.tinymce')
@push('js')
    <script>
        $('#tiny').tinymce({});
    </script>
@endpush
@section('content')
    {{ Form::open(['route' => ['boilerplate.articles.update', $articles->id], 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
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
            <div class="col-12 ">
                @component('boilerplate::card', ['title' => __('boilerplate::articles.informations')])
                @csrf
                    <div class="w-50 mx-auto">
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'title', 'label' => 'boilerplate::articles.name', 'id' => 'title','onkeyup' => 'ChangeToSlug()', 'value' => $articles->title])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::articles.slug','id' => 'slug', 'value' => $articles->slug])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'excerpt', 'label' => 'boilerplate::articles.excerpt','id' => 'summary-ckeditor', 'value' => $articles->excerpt])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'body','id' => 'summary-ckeditor-one','type' => 'textarea','rows' => '4', 'label' => 'boilerplate::articles.description', 'value' => $articles->body])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'image_path','onchange'=>'previewFile(this)','type' => 'file', 'id'=>'files' , 'label' => 'boilerplate::articles.image'])@endcomponent
                                <img id="previewImg" src="{{asset('uploads/'.$articles->image_path)}}" alt="Ảnh minh họa" width="100" height="100">
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection