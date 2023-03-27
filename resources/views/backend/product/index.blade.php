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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách sản phẩm</h4>
                <div class="table-responsive">
                    <!-- <a href="{{ url('excel/products') }}">
                        <button type="button" class="btn btn-primary mb-3">EXCEL</button>
                    </a> -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" placeholder="Tìm kiếm sản phẩm" autofocus>
                    </div>
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá trị($)</th>
                                <th>Số lượng</th>
                                <th>Loại sản phẩm</th>
                                <th>Danh mục sản phẩm</th>
                                <th class="text-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if (count($product->images) > 0)
                                        <img src="{{ $product->images[0]->path }}" width="100" height="100" class="of-cover">
                                    @endif
                                </td>
                                <td>{{ money($product->price)}}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->subcategory->name }}</td>
                                <td>
                                    <a href="{{ route('products.show', ['product' => $product->id ]) }}"
                                        data-toggle="tooltip" data-original-title="Chi tiết">
                                        <i class="fa fa-eye m-r-15" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('products.edit', ['product' => $product->id ]) }}"
                                        data-toggle="tooltip" data-original-title="Cập nhật">
                                        <i class="fa fa-pencil text-inverse m-r-10"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', ['product' => $product->id ]) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn-none" type="submit" data-toggle="tooltip" data-original-title="Xoá">
                                            <i class="fa fa-close text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
