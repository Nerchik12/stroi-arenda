<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = DB::table('orders')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach($orders as $order){
            
            $user = DB::table('users')
                ->where('id', $order->user_id)
                ->first();
            $order->user_name = $user ? $user->name : 'Неизвестный';
            

            $order->products = DB::table('order_cart')
                ->select(
                    'products.name as product_name',
                    'order_cart.quantity',
                    'order_cart.unit_price',
                    DB::raw('COALESCE(order_cart.rental_days, 1) as rental_days'),
                    DB::raw('order_cart.quantity * order_cart.unit_price * COALESCE(order_cart.rental_days, 1) as item_total')
                )
                ->join('products', 'products.id', '=', 'order_cart.products_id')
                ->where('order_cart.order_id', $order->id)
                ->get();
        }
        
        return view('orders', compact('orders'));
    }

public function removeOrders(Request $request)
{
    $orderId = $request->input('order_id');
    $userId = Auth()->user()->id;
    

    DB::table('order_cart')->where('order_id', $orderId)->delete();
    DB::table('orders')
        ->where('id', $orderId)
        ->where('user_id', $userId) 
        ->delete();
    
    return redirect()->back();
}
}