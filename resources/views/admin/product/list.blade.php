@extends('admin.master')

@section('content')
<div class="container mt-3">
    <div class="row mb-9 align-items-center justify-content-between">
        <div class="col-md-6 mb-8 mb-md-0">
            <h2 class="fs-4 mb-0">Product List</h2>
        </div>
        <div class="col-md-6 d-flex flex-wrap justify-content-md-end">
            <a href="{{ route('orders.create') }}" class="btn btn-success">
                Create new
            </a>
        </div>
    </div>
    <div class="card mb-4 rounded-4 p-7 ">
        <div class="col-md-4 col-12 mr-auto mb-md-0 mb-6">
            <select class="form-select">
                <option selected="" data-select2-id="3">All Categories</option>
                <option>Women's Clothing</option>
                <option>Men's Clothing</option>
                <option>Cellphones</option>
                <option>Computer &amp; Office</option>
                <option>Consumer Electronics</option>
                <option>Jewelry &amp; Accessories</option>
                <option>Home &amp; Garden</option>
                <option>Luggage &amp; Bags</option>
                <option>Shoes</option>
                <option>Mother &amp; Kids</option>
            </select>
        </div>
        <table class="table m-3">
            <thead>
                <tr>
                    <th></th>
                    <th>#ID</th>
                    <th>Thông tin khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết đơn hàng</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian sửa</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr class="table-warning">
                <td class="text-center">
                    <div class="form-check">
                        <input class="form-check-input rounded-0 ms-0" type="checkbox"
                            id="transactionCheck-0">
                        <label class="form-check-label" for="transactionCheck-0"></label>
                    </div>
                </td>
                <td>{{ $order->id}}</td>
                <td>
                    <ul>
                        <li>Tên:{{$order->customer->name}}</li>
                        <li>Email:{{$order->customer->email}}</li>
                        <li>Địa chỉ:{{$order->customer->address}}</li>
                        <li>SĐT:{{$order->customer->phone}}</li>
                    </ul>
                </td>
                <td>{{ number_format($order->total_amount)}}</td>
                <td>
                    @foreach ($order->details as $detail)
                    <h6>Sản phẩm: {{$detail->name}}</h6>
                    <ul>
                        <li>Giá: {{ number_format($detail->pivot->price)}}</li>
                        <li>Số lượng: {{$detail->pivot->qty}}</li>
                        @if ($detail->image)
                        <li>
                            <img src="{{ asset('storage/'.$detail->image)}}" alt="">
                        </li>  
                        @endif
                    </ul>
                    @endforeach
                </td>

                <td style="width: 1px;" class="text-nowrap">
                    <a href="" class="btn btn-warning btn-sm"><i
                            class="fa-regular fa-pen-to-square"></i> Edit</a>
                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                        Delete</button>
                </td>
            </tr>
              @endforeach
               
            </tbody>
        </table>
        
    </div>
    <div>
        {{ $orders->links() }}
    </div>
    <ul class="pagination pagination-sm ">
        <li class="page-item"><a class="page-link text-black" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link text-black" href="#">1</a></li>
        <li class="page-item"><a class="page-link text-black" href="#">2</a></li>
        <li class="page-item"><a class="page-link text-black" href="#">3</a></li>
        <li class="page-item"><a class="page-link text-black" href="#">Next</a></li>
      </ul>

</div>
@endsection