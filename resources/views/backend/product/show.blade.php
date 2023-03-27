@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="p-2">{{ $product->name }}</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center"> <img src="/{{ $product->first_image }}" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title">Mô tả sản phẩm</h4>
                            <p>{!! $product->description !!}</p>
                            <h2 class="m-t-40">{{ money($product->price)}}<small
                                    class="text-success"> ({{ $product->discount }}% off)</small></h2>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">Chi tiết đơn hàng</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="390">Tên sản phẩm</td>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số lượng</td>
                                            <td>{{ $product->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Giá trị</td>
                                            <td>{{ money($product->price)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Khuyến mãi (%)</td>
                                            <td>{{ $product->discount }} %</td>
                                        </tr>
                                        <tr>
                                            <td>Giá trị đã giảm</td>
                                            <td>{{ money($product->after_discount)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kích cỡ</td>
                                            <td>{{ $product->sizes->implode('name', ', ') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Màu sắc</td>
                                            <td>{{ $product->colors->implode('name', ', ') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Loại sản phẩm</td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Danh mục sản phẩm</td>
                                            <td>{{ $product->subCategory->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số lương đơn hàng đẵ thành công</td>
                                            <td>{{ $product->orders->count() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
