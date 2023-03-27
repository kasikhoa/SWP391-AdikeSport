@extends('layouts.backend.app')
@section('content')

    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Bảng điều khiển</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bảng điều khiển</li>
                </ol>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-4">
            <p class="font-weight-bold">Tổng quan</p>
        </div>
        <div class="col-3 ml-auto">
            <div class="form-group">
                <select class="form-control" id="month">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i < 10 ? "0$i" : $i }}" @if ($i == $month) selected @endif>
                            <!-- {{ date('F', mktime(0, 0, 0, $i, 10)) }} -->
                            Tháng {{$i}}
                            <!-- @if ($i == $month) selected @endif -->
                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-screen-desktop"></i></h3>
                                <p class="text-muted">Người dùng</p>
                                <p>({{ $month . date('-Y') }})</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-primary">{{ $newCustomers->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-note"></i></h3>
                                <p class="text-muted">Đơn hàng</p>
                                <p>({{ $month . date('-Y') }})</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-cyan">{{ $newOrders->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-doc"></i></h3>
                                <p class="text-muted">Tổng doanh thu</p>
                                <p>({{ $month . date('-Y') }})</p>
                            </div>
                            <div class="ml-auto">
                                <h4 class="counter text-purple">{{ money($totalIncome) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-6">
                            <h4>Khách hàng gần đây</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newCustomers->take(8) as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="txt-oflo">{{ $item->name }}</td>
                                    <td class="txt-oflo">{{ $item->email }}</td>
                                    <td class="txt-oflo">{{ $item->phone }}</td>
                                    <td class="txt-oflo">
                                        <a href="{{ route('customers.show', ['customer' => $item->id]) }}">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
