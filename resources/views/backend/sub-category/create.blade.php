@extends('layouts.backend.app')
@section('content')
<div class="row page-titles">
    <!-- <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Danh mục sản phẩm</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Danh mục sản phẩm</li>
            </ol>
        </div>
    </div> -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <h3 class="box-title m-b-0 mb-3">Tạo danh mục sản phẩm</h3>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('sub-categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục sản phẩm</label>
                            <input type="text" class="form-control" placeholder="Nhập danh mục sản phẩm" name="name" value="{{ old('name') }}" autocomplete="off">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5 class="m-t-30">Chọn loại sản phẩm</h5>
                            <select class="custom-select" name="category_id">
                                <option selected value="">Loại sản phẩm</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tạo danh mục sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
