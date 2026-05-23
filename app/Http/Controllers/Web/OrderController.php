<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller{

    public function checkPhone(Request $request){
        $phone = $request->input('phone');
        $phoneNormalized = preg_replace('/\s+/', '', $phone);
        $activeOrder = Order::whereRaw(
            "REPLACE(phone, ' ', '') = ?", [$phoneNormalized]
        )->whereIn('status', ['new', 'pending'])->latest()->first();
        if ($activeOrder) {
            return Response::json([
                'active_order_exists' => true,
                'latest_order'        => null,
                'message'             => 'Ushbu telefon raqamda aktiv buyurtma mavjud. Yangi buyurtma yaratish mumkin emas.',
            ]);
        }
        $latestOrder = Order::whereRaw(
            "REPLACE(phone, ' ', '') = ?", [$phoneNormalized]
        )->whereIn('status', ['success', 'cancel'])->latest()->first();
        if ($latestOrder) {
            return Response::json([
                'active_order_exists' => false,
                'latest_order'        => [
                    'address'   => $latestOrder->address,
                    'region_id' => $latestOrder->region_id,
                ],
                'message' => "Oldingi buyurtma ma'lumotlari topildi.",
            ]);
        }
        return Response::json([
            'active_order_exists' => false,
            'latest_order'        => null,
            'message'             => 'Ushbu telefon raqam uchun avvalgi buyurtmalar topilmadi.',
        ]);
    }

    public function index(){
        $region = Region::where('status', true)->orderby('name', 'asc')->get();
        $order = Order::whereIn('status',['new','pending'])->orderby('id','desc')->get();
        return view('orders.index', compact('region','order'));
    }

    public function store(StoreOrderRequest $request){
        $validated = $request->validated();
        $orderData = array_merge($validated, [
            'cash'           => 0.00,
            'card'           => 0.00,
            'bank'           => 0.00,
            'full_contaner'  => 0,
            'empty_contaner' => 0,
            'status'         => 'new',   
            'operator_id'    => Auth::id(),           
        ]);
        Order::create($orderData);
        return redirect()->back()->with('success', 'Yangi buyurtma muvaffaqiyatli qabul qilindi!');
    }

    public function index_end(){
        $order = Order::whereIn('status',['success','cancel'])->orderby('id','desc')->get();
        return view('orders.end', compact('order'));
    }

    public function show(int $id){
        return view('orders.show');
    }
}