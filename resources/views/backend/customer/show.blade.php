@extends('layouts.backend.app')
@section('content')
    <div class="row my-4">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card"> <img class="card-img" src="{{ asset('/images/socialbg.jpeg') }}" height="456" alt="Card image">
                <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                    <div class="align-self-center"> <img src="/{{ $customer->avatar }}" class="customer-avatar" width="100">
                        <h4 class="card-title">{{ $customer->name }}</h4>
                        <h6 class="card-subtitle">{{ $customer->email }}</h6>
                        <p class="text-white"></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <small class="text-muted">Email </small>
                    <h6>{{ $customer->email }}</h6>
                    <small class="text-muted p-t-30 db">Ngày/Tháng/Năm sinh</small>
                    <h6>{{ $customer->date_of_birth }}</h6>
                    <small class="text-muted p-t-30 db">Số điện thoại</small>
                    <h6>{{ $customer->phone }}</h6>
                    <small class="text-muted p-t-30 db">Địa chỉ</small>
                    <h6>{{ $customer->address }}</h6>
                    <small class="text-muted p-t-30 db">Tỉnh/Thành phô</small>
                    <h6>{{ $customer->province->name ?? '' }}</h6>
                    <small class="text-muted p-t-30 db">Quận/Huyện</small>
                    <h6>{{ $customer->district->name ?? ''}}</h6>
                    <small class="text-muted p-t-30 db">Phường/Xã/Thị trấn</small>
                    <h6>{{ $customer->ward->name ?? ''}}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#wishlist" role="tab">Danh sách ưa thích</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#viewed" role="tab">Sản phẩm đã xem</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="review" role="tabpanel">
                        <div class="card-body">
                        </div>
                    </div>
                    <div class="tab-pane" id="wishlist" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                @foreach ($wishlist as $value)
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <a href="{{ route('product-details', ['product' => $value->product_id]) }}" class="link">{{ $customer->name }}</a>
                                            <span class="sl-date">{{ $value->created_at->format('m-d-Y') }}</span>
                                            <p class="mt-3">
                                                <a class="body" href="{{ route('product-details', ['product' => $value->product_id]) }}">
                                                    Tên sản phẩm: {{ $value->product->name }}
                                                </a>
                                            </p>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 m-b-20">
                                                    <img src="/{{ $value->product->first_image }}" class="img-responsive radius"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="viewed" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                @foreach ($viewed_products as $value)
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <div>
                                            <a href="{{ route('product-details', ['product' => $value->product_id]) }}" class="link">{{ $customer->name }}</a>
                                            <span class="sl-date">{{ $value->created_at->format('m-d-Y') }}</span>
                                            <p class="mt-3">
                                                <a class="body" href="{{ route('product-details', ['product' => $value->product_id]) }}">
                                                    Tên sản phẩm: {{ $value->product->name }}
                                                </a>
                                            </p>
                                            <p>
                                                Số lượng đã xem: {{ $value->view_numbers }}</p>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 m-b-20">
                                                    <img src="/{{ $value->product->first_image }}" class="img-responsive radius"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
