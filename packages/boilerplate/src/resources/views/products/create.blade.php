@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::products.title'),
    'subtitle' => __('boilerplate::products.create.title'),
    'breadcrumb' => [
        __('boilerplate::products.title') => 'boilerplate.products.index',
        __('boilerplate::products.create.title')
    ]
])
@include('boilerplate::load.fileinput')
@section('content')
    {{ Form::open(['route' => 'boilerplate.products.createPost', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
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
                                    @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::products.name','id' => 'title','onkeyup' => 'ChangeToSlug()', 'autofocus' => true])@endcomponent
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    @component('boilerplate::input', ['name' => 'slug','id' => 'slug', 'label' => 'boilerplate::products.slug'])@endcomponent
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Category_id</label>
                                    <select name="category_id" class="form-control">
                                    <option value="" default>---Please choose---</option>
                                        @foreach($category as $value)
                                            <option value="{{$value->id}}"> {{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                            @component('boilerplate::input', ['name' => 'description','type' => 'textarea','id' => 'tiny','rows' => '6', 'label' => 'boilerplate::products.description'])@endcomponent
                            @component('boilerplate::input', ['name' => 'image_path','onchange'=>'previewFile(this)','type' => 'file', 'id'=>'files' , 'label' => 'boilerplate::products.image'])@endcomponent
                            <img id="previewImg" src="" alt="Ảnh minh họa" width="100" height="100">
                        </div>
                    @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection