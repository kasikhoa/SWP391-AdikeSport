@extends('layouts.frontend.app')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đặt hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <i class="fa fa-caret-right mx-2" aria-hidden="true"></i>
                            <span>Đặt hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                    <input type="hidden" value="{{ $total }}" id="old_price">
                    <input type="hidden" value="{{ $total }}" name="price" id="price">
                    <input type="hidden" value="0" name="discount" id="discount">
                    <div class="row edit-input-btn">
                        <div class="col-lg-8 col-md-6 mb-5">
                            <h6 class="checkout__title">Thông tin đặt hàng</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>

                                        <input type="text" placeholder="Full Name" name="customer_name" required
                                            autocomplete="off" value="{{ old('customer_name', $user->name ?? '') }}">

                                        @error('customer_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>

                                        <input type="text" placeholder="Số điện thoại" required name="customer_phone"
                                            autocomplete="off" value="{{ old('customer_phone', $user->phone ?? '') }}">

                                        @error('customer_phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>

                                        <input type="text" placeholder="Email" name="customer_email" autocomplete="off"
                                            value="{{ old('customer_email', $user->email ?? '') }}">

                                        @error('customer_email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Ghi chú</p>
                                        <input type="text" name="notes" value="{{ old('notes') }}"
                                            placeholder="Ghi chú cho đơn hàng.">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Địa chỉ<span>*</span></p>

                                        <input type="text" placeholder="Địa chỉ" class="checkout__input__add"
                                            autocomplete="off" name="customer_address"
                                            value="{{ old('customer_address', $user->address ?? '') }}">

                                        @error('customer_address')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 custom-nice-select mb-5 province">
                                    <div class="checkout__input">
                                        <p>Tỉnh/Thành phố<span>*</span></p>
                                        <select id="province" name="province_id">
                                            <option selected value="">Chọn Tỉnh/Thành phố</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    {{ $province->id == old('province_id', $user->province_id ?? '') ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <div class="error error-nice-select">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 custom-nice-select district">
                                    <div class="checkout__input">
                                        <p>Quận/Huyện<span>*</span></p>
                                        <select id="district" name="district_id">
                                            @foreach ($user->province->districts ?? [] as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ $district->id == $user->district_id ?? '' ? 'selected' : '' }}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach

                                            @if (!($user->province_id ?? null))
                                                <option selected value="">Chọn Quận/Huyện</option>
                                            @endif
                                        </select>
                                        @error('district_id')
                                            <div class="error error-nice-select">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 custom-nice-select ward">
                                    <div class="checkout__input">
                                        <p>Phường/Xã/Thị trấn<span>*</span></p>
                                        <select id="ward" name="ward_id">
                                            @foreach ($user->district->wards ?? [] as $ward)
                                                <option value="{{ $ward->id }}"
                                                    {{ $ward->id == $user->ward_id ?? '' ? 'selected' : '' }}>
                                                    {{ $ward->name }}
                                                </option>
                                            @endforeach

                                            @if (!($user->district_id ?? null))
                                                <option selected value="">Chọn Phường/Xã/Thị trấn</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('ward_id')
                                        <div class="error error-nice-select">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Chi tiết đơn hàng</h4>
                                <div class="checkout__order__products font-weight-bold">Sản phẩm <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach ($products as $product)
                                        @foreach ($cart[$product->id] as $index => $item)
                                            @php
                                                $attribute = $product->firstAttribute($item);
                                            @endphp

                                            <input type="hidden" name="size_id[]" value="{{ $item['size'] }}">
                                            <input type="hidden" name="color_id[]" value="{{ $item['color'] }}">
                                            <input type="hidden" name="product_id[]" value="{{ $item['product_id'] }}">
                                            <input type="hidden" name="quantity[]" value="{{ $item['quantity'] }}">
                                            <input type="hidden" name="total[]"
                                                value="{{ $product->after_discount * $item['quantity'] }}">
                                            <li>
                                                <div>{{ $product->name }} - {{ $attribute->color->name }}<br>
                                                    Kích cỡ: {{ $attribute->size->name }}
                                                </div>
                                                Sô lượng: {{ $item['quantity'] }}
                                                <span>{{ money($product->after_discount * $item['quantity']) }}</span>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tổng giá trị đơn hàng($) <span>{{ money($total) }}</span></li>
                                    <li>Khuyến mãi <span id="order_discount">0%</span></li>
                                    <li>Tổng giá trị đơn hàng sau khi giảm ($) <span id="order_total">{{ money($total) }}</span></li>
                                </ul>
                                @if ($products->count() > 0)
                                    <p><b>Phương thức thanh toán</b></p>
                                    <div class="mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cod" name="customRadio" class="custom-control-input"
                                                checked>
                                            <label class="custom-control-label fw-600 fs-15" for="cod">COD</label>
                                            <button type="button" class="info-paypal-btn" data-toggle="tooltip" data-placement="top" title="Pay on delivery">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if ($products->count() > 0)
                                    <button type="submit" class="site-btn" id="site-btn">
                                        Đặt hàng
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
