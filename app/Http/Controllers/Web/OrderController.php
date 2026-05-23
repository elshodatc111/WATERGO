<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function checkPhone(Request $request)
    {
        $phone = $request->input('phone');

        // Input: "+998 90 883 0450" → normalize → "+998908830450"
        $phoneNormalized = preg_replace('/\s+/', '', $phone);

        $activeOrder = Order::whereRaw(
            "REPLACE(phone, ' ', '') = ?", [$phoneNormalized]
        )->whereIn('status', ['new', 'pending'])
         ->latest()
         ->first();

        if ($activeOrder) {
            return Response::json([
                'active_order_exists' => true,
                'latest_order'        => null,
                'message'             => 'Ushbu telefon raqamda aktiv buyurtma mavjud. Yangi buyurtma yaratish mumkin emas.',
            ]);
        }

        $latestOrder = Order::whereRaw(
            "REPLACE(phone, ' ', '') = ?", [$phoneNormalized]
        )->whereIn('status', ['success', 'cancel'])
         ->latest()
         ->first();

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

    public function index()
    {
        $region = Region::where('status', true)->orderby('name', 'asc')->get();
        return view('orders.index', compact('region'));
    }

    public function show(int $id)
    {
        return view('orders.show');
    }
}