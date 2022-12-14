@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::products.title'),
    'subtitle' => __('boilerplate::products.edit.title'),
    'breadcrumb' => [
        __('boilerplate::products.title') => 'boilerplate.products.index',
        __('boilerplate::products.edit.title')
    ]
])
@include('boilerplate::load.fileinput')
@section('content')
    {{ Form::open(['route' => ['boilerplate.products.update', $product->id], 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
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
            <div class="col-12 ">
                @component('boilerplate::card', ['title' => __('boilerplate::products.informations')])
                @csrf
                    <div class="w-50 mx-auto">
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::products.name', 'id' => 'title','onkeyup' => 'ChangeToSlug()', 'value' => $product->name])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'slug', 'label' => 'boilerplate::products.slug','id' => 'slug', 'value' => $product->slug])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Category_id</label>
                                    <select name="category_id" class="form-control">
                                    @foreach($category as $value)
                                        <option value="{{$value->id}}" {{$value->id== $product->category_id ? 'selected' : ''}}> {{$value->name}}</option>
                                    @endforeach
                                    </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'description','type' => 'textarea','id' => 'summary-ckeditor','rows' => '4', 'label' => 'boilerplate::products.description', 'value' => $product->description])@endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @component('boilerplate::input', ['name' => 'image_path','onchange'=>'previewFile(this)','type' => 'file', 'id'=>'files' , 'label' => 'boilerplate::products.image'])@endcomponent
                                <img id="previewImg" src="{{asset('uploads/'.$product->image_path)}}" alt="Ảnh minh họa" width="100" height="100">
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection