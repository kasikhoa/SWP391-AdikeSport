@extends('layouts.frontend.app')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
        </div>
    </section>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a class="btn btn-dark collapseSidebar mb-4" data-toggle="collapse" href="#collapseSidebar"
                        role="button" aria-expanded="false" aria-controls="collapseSidebar">
                        Show / Hide Filter
                    </a>
                    <div class="shop__sidebar collapse show" id="collapseSidebar">
                        <div class="shop__sidebar__search">
                            <input type="text" placeholder="Tìm kiếm tên sẩn phẩm" id="nameFilter">
                        </div>
                        <div class="shop__sidebar__accordion">
                            <input type="hidden" id="filterUrl"
                                value="/filter?sortby=asc&category={{ request('category') }}&subcategory={{ request('subcategory') }}&sale={{ request('sale', 'no') }}&price=&size=&color=&name=&offset={{ $products->count() }}&limit=5">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Loại sản phẩm</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <input type="hidden" id="categorySelected" value={{ request('category') }}>
                                                    @foreach ($categories as $category)
                                                            <li class="category
                                                                @if ($category->id == request('category')) active @endif">
                                                                <input type="hidden" value="{{ $category->id }}"
                                                                    id="category_id">
                                                                <span>{{ $category->name }}</span>
                                                            </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Danh mục</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <input type="hidden" id="subCategorySelected" value={{ request('subcategory') }}>
                                                    @foreach ($subCategories as $subCategory)
                                                        <li class="sub-category
                                                            @if (request('subcategory') == $subCategory->id) active @endif">
                                                            <input type="hidden" value="{{ $subCategory->id }}"
                                                                id="sub_category_id">
                                                            <span>{{ $subCategory->name }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Lọc theo giá</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <input type="hidden" id="priceSelected">
                                                    <li class="price">
                                                        <input type="hidden" value="0" id="price">
                                                        <span>< 200$</span>
                                                    </li>

                                                    <li class="price">
                                                        <input type="hidden" value="1" id="price">
                                                        <span>200 - 299$</span>
                                                    </li>

                                                    <li class="price">
                                                        <input type="hidden" value="2" id="price">
                                                        <span>300 - 399$</span>
                                                    </li>

                                                    <li class="price">
                                                        <input type="hidden" value="3" id="price">
                                                        <span>400 - 499$</span>
                                                    </li>

                                                    <li class="price">
                                                        <input type="hidden" value="4" id="price">
                                                        <span> > 500$</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <input type="hidden" id="sizeSelected">
                                                @foreach ($sizes as $size)
                                                    <label for="sz{{ $size->id }}">
                                                        {{ $size->name }}
                                                        <input class="sizeFilter" type="radio" id="sz{{ $size->id }}"
                                                            value="{{ $size->id }}">
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left d-flex">
                                    <p>Tìm thấy {{ $products->count() }} kết quả</p>
                                    <div class="spinner-border spinner-border-sm ml-3" role="status" id="spinner"></div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp theo giá:</p>
                                    <select id="sortby">
                                        <option value="asc">Thấp đến cao</option>
                                        <option value="desc">Cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="products">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="/{{ $product->first_image }}">
                                        @if ($product->discount > 0)
                                            <span class="label">Sale</span>
                                        @endif
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
                    <div class="row justify-content-center">
                        <button type="button" class="site-btn mt-5 loadmore" id="shop_loadmore">
                            Xem thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
