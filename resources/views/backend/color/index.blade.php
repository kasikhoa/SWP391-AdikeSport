@extends('layouts.backend.app')
@section('content')
<div class="row page-titles">
    <!-- <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Màu sắc</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Màu sắc</li>
            </ol>
        </div>
    </div> -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách màu sắc</h4>
                <div class="table-responsive">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" placeholder="Tìm kiếm màu sắc" autofocus>
                    </div>
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Tên màu sắc</th>
                                <th class="text-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <a href="{{ route('colors.edit', ['color' => $color->id ]) }}"
                                        data-toggle="tooltip" data-original-title="Cập nhật">
                                        <i class="fa fa-pencil text-inverse m-r-10"></i>
                                    </a>
                                    <form action="{{ route('colors.destroy', ['color' => $color->id ]) }}" method="post" class="d-inline">
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
                {{ $colors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
