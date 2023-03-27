@extends('layouts.frontend.app')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
    </div>
</section>
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá Trị ($)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $index=>$item)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic mb-3">
                                            <img width="100" src="{{ $item->product->first_image }}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>
                                                <a href="{{ route('product-details', ['product' => $item->product_id])  }}">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ money($item->product->after_discount) }}</td>
                                    <td class="cart__close text-center">
                                        <form action="{{ route('wishlist.destroy', ['wishlist' => $item->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('shop') }}">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection