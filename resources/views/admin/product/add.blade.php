@extends('admin.master')
@section('title')
    Thêm đơn hàng 
@endsection
@section('content')

@if (session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

<div class="container mt-3">
    <div class="row mb-9 align-items-center justify-content-between">
        <div class="col-md-6 mb-8 mb-md-0">
            <h2 class="fs-4 mb-0"> Add Product</h2>
        </div>
        
        <form action="{{ route('orders.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mt-3 mb-4">Khách hàng</h4>
                    <div class="mt-3">
                        <label for="customer_name">Tên khách hàng:</label>
                        <input type="text" name="customer[name]" value="{{ old('customer.name')}}" id="customer_name" class="form-control">
                        @error('customer.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Địa chỉ:</span>
                        <input class="form-control" type="text" name="customer[address]" value="{{ old('customer.address')}}" id="customer_address">
                        @error('customer.address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Số điện thoại:</span>
                        <input class="form-control" type="tel" name="customer[phone]" value="{{old('customer.phone')}}" id="customer_phone">
                        @error('customer.phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Email:</span>
                        <input class="form-control" type="email" name="customer[email]" value="{{ old('customer.email')}}" id="customer_email">
                        @error('customer.email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="mt-3 mb-3">Nhà Cung Cấp</h4>
                    <div class="mt-3">
                        <span class="form-label">Tên nhà cung cấp:</span>
                        <input class="form-control" type="text" name="supplier[name]" value="{{ old('supplier.name')}}" id="supplier_name">
                        @error('supplier.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Địa chỉ:</span>
                        <input class="form-control" type="text" name="supplier[address]" value="{{ old('supplier.address')}}" id="supplier_address">
                        @error('supplier.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Số điện thoại:</span>
                        <input class="form-control" type="tel" name="supplier[phone]" value="{{ old('supplier.phone')}}" id="supplier_phone">
                        @error('supplier.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="mt-3">
                        <span class="form-label">Email:</span>
                        <input class="form-control" type="email" name="supplier[email]" value="{{ old('supplier.email')}}" id="supplier_email">
                        @error('supplier.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>
           

            <div class="col-md-12 mt-5">
                <h2 class="mt-3 mb-3">Danh sách sản phẩm</h2>
                <div class="d-flex">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Nhà cung cấp</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Số lượng kho</th> 
                            <th>Số lượng bán</th>
                          </tr>
                        </thead>
                        
                        @for($i = 0; $i < 2; $i++)
                        <tbody>
                      
                          <tr>
                            <td>
                                <select name="products[{{ $i }}][suppliers_id]" id="">
                                   @foreach ($suppliers as $supplier)
                                      <option value="{{ $supplier->id }}" {{ old("products.$i.suppliers_id") == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                   @endforeach
                                </select>
                                @error("products.$i.suppliers_id")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                             </td>
                            <td>
                                <input type="text" class="form-control" name="products[{{ $i }}][name]"  value="{{old("products.$i.name")}}">
                                @error("products.$i.name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </td>
                            <td>
                                <input type="file" class="form-control" name="products[{{ $i }}][image]" >
                                @error("products.$i.image")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control" name="products[{{ $i }}][description]" value="{{ old("products.$i.description")}}" >
                                @error("products.$i.description")
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control" name="products[{{ $i}}][price]" value="{{ old("products.$i.price")}}">
                                @error("products.$i.price")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control" name="products[{{ $i}}][stock_qty]" value="{{ old("products.$i.stock_qty")}}">
                                @error("products.$i.stock_qty")
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control" name="order_details[{{ $i}}][qty]" value="{{ old("order_details.$i.qty")}}">
                                @error("order_details.$i.qty")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </td>
                          </tr>
                        </tbody>
                        @endfor
                        
                      </table>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-wrap justify-content-md-end">
                <a href="add.html" class="btn btn-secondary m-2"><i class="fa-solid fa-rotate-right"></i> Back </a>
                <button type="submit" class="btn btn-success m-2"> <i class="fa-solid fa-plus"></i> Add new</button>
            </div>
        </form>
    </div>

</div>
@endsection