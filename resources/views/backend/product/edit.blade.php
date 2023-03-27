@extends('layouts.backend.app')
@section('content')
    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Sản phẩm</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sản phẩm</li>
                </ol>
            </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h3 class="box-title m-b-0 mb-3">Cập nhật sản phẩm</h3>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name"
                                    value="{{ old('name', $product->name) }}" autocomplete="off">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" value="{{ $product->allattributes->count() }}" id="currentAttribute">
                            <input type="hidden" value="{{ $sizes->count() * $colors->count() }}" id="maxOfAttribute">

                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="card-title m-0 mr-3">Thuộc tính sản phẩm</p>
                                        <button type="button" class="btn btn-dark btn-sm" id="addAttribute">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table">
                                            <thead>
                                                <tr>
                                                    <th>Kích cỡ</th>
                                                    <th>Màu sắc</th>
                                                    <th>Số lượng</th>
                                                    <th>Hình ảnh</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="attributeWrapper">
                                                @foreach ($product->allattributes as $index => $attribute)
                                                    <div style="display: none">
                                                        @foreach ($attribute->images as $image)
                                                            <input type="checkbox" name="old_images{{ $index }}[]"
                                                                value="{{ $image->path }}" checked>
                                                        @endforeach
                                                    </div>
                                                    <tr>
                                                        <td>
                                                            <select class="custom-select" name="sizes[]">
                                                                <option selected value="">Kích cỡ</option>
                                                                @foreach ($sizes as $size)
                                                                    <option value="{{ $size->id }}" @if ($size->id == $attribute->size_id) selected @endif>
                                                                        {{ $size->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="custom-select" name="colors[]">
                                                                <option selected value="">Màu sắc</option>
                                                                @foreach ($colors as $color)
                                                                    <option value="{{ $color->id }}" @if ($color->id == $attribute->color_id) selected @endif>
                                                                        {{ $color->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Quantity" name="quantity[]"
                                                                value="{{ $attribute->product_quantity }}">
                                                        </td>
                                                        <td>
                                                            <div class="custom-file">
                                                                <input type="file" multiple class="custom-file-input"
                                                                    name="images{{ $index }}[]" accept="image/*">
                                                                <label class="custom-file-label">Chọn hình ảnh</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button class="btn-none deleteAttribute" data-toggle="tooltip"
                                                                data-original-title="Xoá">
                                                                <i class="fa fa-close text-danger"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @error('sizes.*')
                                <div class="error">The size field is required.</div>
                            @enderror
                            @error('colors.*')
                                <div class="error">The size field is required.</div>
                            @enderror
                            @error('quantity.*')
                                <div class="error">The quantity field is required.</div>
                            @enderror

                            <div class="form-group">
                                <h5 class="m-t-30">Chọn danh mục sản phẩm</h5>
                                <select class="custom-select" name="sub_category_id">
                                    <option selected value="">Chọn danh mục</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" @if (old('sub_category_id', $product->subcategory->id) == $subCategory->id) selected @endif>
                                            {{ $subCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá trị sản phẩm</label>
                                <input type="number" class="form-control" placeholder="Nhập giá trị" name="price"
                                    value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Khuyên mãi (%)</label>
                                <input type="number" class="form-control" placeholder="Nhập khuyến mãi" name="discount"
                                    value="{{ old('discount', $product->discount) }}" min="0" max="100">
                                @error('discount')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea id="summernote" name="description">{!! old('description', $product->description) !!}</textarea>
                            </div>

                            <button type="submit" class="btn btn-danger"> <i class="fa fa-pencil"></i>Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
