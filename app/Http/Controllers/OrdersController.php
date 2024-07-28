<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Suppliers;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::with(['customer', 'details'])->latest('id')->paginate(1);
        return view('admin.product.list', compact('orders'));
    }
    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('admin.product.add', compact('suppliers'));
    }


    public function store(StoreOrderRequest $request){
        $images = [];
        try {
            DB::transaction(function () use ($request, &$images){
                $customer = Customers::create($request->customer);
                $supplier = Suppliers::create($request->supplier);

                $orderDetails = [];
                $totalAmount = 0;
               
                foreach($request->products as $key => $product){
                   
                    if($request->hasFile("products.$key.image")){
                        $images[] = $product['image'] = Storage::put('products', $request->file("products.$key.image"));
                    }

                    $tmp = Products::query()->create($product);
                    $orderDetails[$tmp->id] = [
                        'qty' => $request->order_details[$key]['qty'],
                        'price' => $tmp->price
                    ];
                    $totalAmount += $request->order_details[$key]['qty'] * $tmp->price;
                }
                $order = Orders::query()->create([
                    'customer_id' => $customer->id,
                    'total_amount' => $totalAmount,
                ]);
                $order->details()->attach($orderDetails);
            }, 3);
            return redirect()
                ->route('orders.product.list')
                ->with('success', 'Thao tác thành công');
        } catch (Exception $exception) {
            
            foreach($images as $image){
                if (Storage::exists($image)){
                    Storage::delete($image);
                }
            }
            return back()->with('error', $exception->getMessage());
        }
        
    }
}
