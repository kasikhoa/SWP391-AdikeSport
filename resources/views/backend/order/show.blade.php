@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">Chi tiết đơn hàng</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="390">Tên khách hàng</td>
                                            <td>{{ $order->customer_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>{{ $order->customer_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $order->customer_email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td>{{ $order->customer_address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tỉnh/Thành phố</td>
                                            <td>{{ $order->province->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quận/Huyện</td>
                                            <td>{{ $order->district->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phường/Xã/Thị trấn</td>
                                            <td>{{ $order->ward->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ghi chú</td>
                                            <td>{{ $order->notes }}</td>
                                        </tr>
                                        <tr>
                                            <td>Giá trị đã khuyến mãi (after discount)</td>
                                            <td>{{ money($order->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Khuyến mãi</td>
                                            <td>{{ $order->discount }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái</td>
                                            <td>
                                                <input type="hidden" id="order_id" value="{{ $order->id }}">
                                                <select class="form-control" id="order_status">
                                                    <option {{ $order->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                                    <option {{ $order->status == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng</option>
                                                    <option {{ $order->status == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng</option>
                                                </select>
                                            </td>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Màu sắc</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->size->name }}</td>
                                    <td>{{ $item->color->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
