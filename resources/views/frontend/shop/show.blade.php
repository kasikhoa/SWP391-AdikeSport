@extends('layouts.frontend.app')
@section('css')
    <link href="{{ asset('backend/lightbox/css/lightbox.css') }}" rel="stylesheet" />
@endsection
@section('script')
    <script src="{{ asset('js/product_details.js') }}"></script>
    <script src="{{ asset('backend/lightbox/js/lightbox.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 10,
            'wrapAround': true,
            'disableScrolling': true
        })

    </script>
@endsection
@section('content')
    <section class="shop-details">
        <div class="product__details__pic">
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 col-md-9 mb-5">
                        <div class="tab-content">
                            <div class="product__details__pic__item">
                                <a href="/{{ $product->first_image }}" data-lightbox="main-image" id="main-image-link">
                                    <img src="/{{ $product->first_image }}" class="img-thumbnail" id="main-image">
                                </a>
                            </div>
                        </div>
                        <div id="tab_image" class="owl-carousel mt-3">
                            @foreach ($product->attributes as $attributeKey => $attribute)
                                @foreach ($attribute->images as $imageKey => $image)
                                    <div class="tab-image @if ($attributeKey==0 && $imageKey==0) active @endif">
                                        <a href="#tab{{ $image->id }}">
                                            <input type="hidden" value="/{{ $image->path }}"
                                                id="attribute{{ $attribute->id }}">
                                            <div class="product__thumb__pic set-bg img-thumbnail"
                                                data-setbg="/{{ $image->path }}"></div>
                                        </a>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <h3>
                                {{ money($product->after_discount) }}
                                @if ($product->discount > 0)
                                    <span>{{ money($product->price) }} $</span>
                                @endif
                            </h3>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Kích cỡ:</span>
                                        @foreach ($sizes as $item)
                                            <label for="size{{ $item->size_id }}" @if ($loop->first) class="active" @endif>
                                                {{ $item->size->name }}
                                                <input type="radio" id="size{{ $item->size_id }}"
                                                    value="{{ $item->size_id }}" name="size" @if ($loop->first) checked @endif
                                                    class="size">
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="product__details__option__color" id="colorWrapper">
                                        <span>Màu sắc: </span>
                                        @foreach ($colors as $item)
                                            <label class="color @if ($loop->first) active @endif" style="background:{{ $item->color->code }}">
                                                <input type="radio" name="color" value="{{ $item->color_id }}" @if ($loop->first) checked @endif>
                                                <i class="fas fa-check"></i>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                @auth
                                    <div class="product__details__cart__option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden" value="{{ $product->id }}" name="product_id"
                                                id="product_id">
                                                <input type="hidden"
                                                value="{{ $product->attributes->first()->product_quantity }}"
                                                id="max_qty">
                                                <span class="fa fa-angle-up dec qtybtn" id="increase"></span>
                                                <input type="text" value="0" id="quantity" name="quantity">
                                                <span class="fa fa-angle-down inc qtybtn" id="decrease"></span>
                                            </div>
                                        </div>
                                        <button id="addToCartBtn" type="submit" class="primary-btn" disabled>Thêm vào giỏ hàng</button>
                                    </div>
                                @endauth
                            </form>
                            @auth
                                <div class="product__details__btns__option">
                                    <form action="{{ route('wishlist.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <button type="submit" class="wishlist">
                                            <i class="fa fa-heart"></i> Thêm vào danh sách ưa thích
                                        </button>
                                    </form>
                                </div>
                            @endauth
                            <div class="product__details__last__option">
                                <h5><span>Thanh toán an toàn</span></h5>
                                <ul>
                                    <li id="in_stock">
                                        <span>Số lượng trong kho:</span>
                                        @if ($product->attributes->first()->product_quantity == 0)
                                            <span class="text-danger">Hết hàng</span>
                                        @else
                                            {{$product->attributes->first()->product_quantity}}
                                        @endif
                                    </li>
                                    <li><span>Loại sản phẩm:</span> {{ $product->category->name }}</li>
                                    <li><span>Danh mục:</span> {{ $product->subCategory->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#tabs-5" role="tab">Mô tả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Thông tin thêm</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content"
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.
                                        </p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.
                                            </p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.
                                            </p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản phẩm liên quan</h3>
                </div>
            </div>
            <div class="row">
                <div id="related-products" class="owl-carousel">
                    @foreach ($relatedProducts as $product)
                        <div class="col-12">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" data-setbg="/{{ $product->first_image }}">
                                    <ul class="product__hover">
                                        <li>
                                            <form action="{{ route('wishlist.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <button type="submit" class="wishlist">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a href="{{ route('product-details', ['product' => $product->id]) }}">
                                                <button type="submit" class="wishlist">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <a href="{{ route('product-details', ['product' => $product->id]) }}"
                                        class="add-cart">+ Thêm vào giỏ hàng</a>
                                    <h5 class="discount">
                                        {{ money($product->after_discount) }}
                                        @if ($product->discount > 0)
                                            <span>{{ money($product->price) }}</span>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
