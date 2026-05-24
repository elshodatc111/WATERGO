<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderChat;
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
        $order = Order::findOrFail($id);
        $region = Region::where('status', true)->orderby('name', 'asc')->get();
        $chat = OrderChat::where('order_id', $id)->orderby('id', 'asc')->get();
        return view('orders.show', compact('order', 'region', 'chat'));
    }

    public function storeChat(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'message'  => 'required|string',
        ]);
        OrderChat::create([
            'order_id' => $request->input('order_id'),
            'message'  => $request->input('message'),
            'user_id'=> Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Xabar muvaffaqiyatli yuborildi!');
    }

    public function storeCancel(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'description'  => 'required|string',
        ]);
        $order = Order::findOrFail($request->input('order_id'));
        $order->status = 'cancel';
        $order->description = $request->input('description');
        $order->save();
        OrderChat::create([
            'order_id' => $request->input('order_id'),
            'message'  => "Buyurtma bekor qilindi. Sabab: " . $request->input('description'),
            'user_id'=> Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Buyurtma muvaffaqiyatli bekor qilindi!');
    }
    
    public function update(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'phone' => 'required|string',
            'address' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ]);
        $order = Order::findOrFail($request->input('order_id'));
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->region_id = $request->input('region_id');
        $order->order_count = $request->input('order_count');
        $order->currer_id = null;
        $order->status = 'new';
        $order->save();
        OrderChat::create([
            'order_id' => $request->input('order_id'),
            'message'  => "Buyurtma ma'lumotlari yangilandi.",
            'user_id'=> Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Buyurtma ma\'lumotlari muvaffaqiyatli yangilandi!');
    }
}