<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
public function cart(){
   $cart = DB::table("cart")
       ->join('products','products.id','=','cart.product_id')
       ->where('cart.user_id', Auth()->user()->id)
       ->select(
           'cart.id as cart_id',
           'cart.count',
           'cart.product_id',
           'cart.status',
           DB::raw('COALESCE(cart.rental_days, 1) as rental_days'),
           'products.name',
           'products.description',
           'products.price',
           'products.image',
           'products.category',
           'products.year',
           'products.country',
           'products.model',
           'products.in_stock',
           'products.updated_at'
       )
       ->get();
    return view('cart',['cart'=>$cart]);
}

public function add(Request $request){
    $product = DB::table('products')->where('id', $request->id)->first();

    if (!$product) {
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Товар не найден']);
        }
        return redirect()->back()->with('error', 'Товар не найден');
    }

    if ($product->in_stock <= 0) {
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Товар закончился на складе']);
        }
        return redirect()->back()->with('error', 'Товар закончился на складе');
    }

    $quantity = (int)$request->quantity;
    if ($quantity < 1) {
        $quantity = 1;
    }

    $rentalDays = (int) $request->input('rental_days', 1);
    if ($rentalDays < 1) {
        $rentalDays = 1;
    }

    // Ищем товар с ТАКИМ ЖЕ сроком аренды
    $cartItem = DB::table('cart')
        ->where('user_id', Auth()->user()->id)
        ->where('product_id', $request->id)
        ->where('status', 'active')
        ->where(DB::raw('COALESCE(rental_days, 1)'), $rentalDays)
        ->first();

    if ($cartItem) {
        $newCount = $cartItem->count + $quantity;

        if ($newCount > $product->in_stock) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Недостаточно товара на складе']);
            }
            return redirect()->back()->with('error', 'Недостаточно товара на складе');
        }

        DB::table('cart')
            ->where('id', $cartItem->id)
            ->update(['count' => $newCount]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Количество товара увеличено']);
        }
        return redirect()->back()->with('success', 'Количество товара увеличено');
    } else {
        DB::table('cart')->insert([
            'user_id' => Auth()->user()->id,
            'product_id' => $request->id,
            'status' => 'active',
            'count' => $quantity,
            'rental_days' => $rentalDays,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Товар добавлен в корзину']);
        }
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }
}

   public function remove(Request $request){
       DB::table('cart')->where('id', $request->cart_id)->delete();
       return redirect()->back();
   }
    public function remove_add(Request $request){
        DB::table('cart')->where('user_id', Auth()->user()->id)->delete();
        return redirect()->back();
    }

    public function updateQuantity(Request $request){
    $cartId = $request->cart_id;
    $newCount = (int) $request->count;
    
    if($newCount < 1) {
        $newCount = 1;
    }
    
    $cartItem = DB::table('cart')->where('id', $cartId)->first();
    if (!$cartItem) {
        return redirect()->back();
    }
    
    $inStock = DB::table('products')
        ->where('id', $cartItem->product_id)
        ->value('in_stock');
    
    if($newCount > $inStock) {
        $newCount = $inStock;
    }
    
    DB::table('cart')
        ->where('id', $cartId)
        ->update(['count' => $newCount]);
    
    return redirect()->back();
}

public function updateRentalDays(Request $request){
    $cartId = $request->cart_id;
    $newDays = (int) $request->days;

    if ($newDays < 1) {
        $newDays = 1;
    }

    $cartItem = DB::table('cart')->where('id', $cartId)->first();
    if (!$cartItem) {
        return redirect()->back();
    }

    // Проверяем, есть ли уже другая запись с таким же product_id и новым rental_days
    $existingItem = DB::table('cart')
        ->where('user_id', $cartItem->user_id)
        ->where('product_id', $cartItem->product_id)
        ->where(DB::raw('COALESCE(rental_days, 1)'), $newDays)
        ->where('id', '!=', $cartId)
        ->first();

    if ($existingItem) {
        DB::table('cart')
            ->where('id', $existingItem->id)
            ->update(['count' => $existingItem->count + $cartItem->count]);
        DB::table('cart')->where('id', $cartId)->delete();
    } else {
        DB::table('cart')
            ->where('id', $cartId)
            ->update(['rental_days' => $newDays]);
    }

    return redirect()->back();
}

public function add_order(){
    $userId = auth()->user()->id;
    
    // товары из корзины
    $cart_items = DB::table('cart')
        ->join('products', 'products.id', '=', 'cart.product_id')
        ->where('cart.user_id', $userId)
        ->where('cart.status', 'active')
        ->select('cart.*', 'products.price', DB::raw('COALESCE(cart.rental_days, 1) as rental_days'))
        ->get();

    //  корзина не пуста
    if ($cart_items->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Корзина пуста');
    }

    //  общая сумма товаров в корзине
    $totalAmount = 0;
    foreach($cart_items as $item){
        $days = max(1, (int) $item->rental_days);
        $totalAmount += $item->price * $item->count * $days;
    }
    
    //  заказ для всех товаров
    DB::table('orders')->insert([
        'user_id' => $userId,
        'status' => 'active',
        'total_amount' => $totalAmount,
        'created_at' => now()
    ]);
    
    //  только что созданный заказ
    $order = DB::table('orders')
        ->where('user_id', $userId)
        ->orderBy('id', 'desc')
        ->first();

    // товары из корзины в этот один заказ
    foreach($cart_items as $cart_item){
        $days = max(1, (int) $cart_item->rental_days);
        DB::table('order_cart')->insert([
            'order_id' => $order->id, 
            'products_id' => $cart_item->product_id,
            'quantity' => $cart_item->count,
            'unit_price' => $cart_item->price,
            'rental_days' => $days,
        ]);
    }
    
    //  очищаем корзину 
    DB::table('cart')
        ->where('user_id', $userId)
        ->where('status', 'active')
        ->delete();

    return redirect()->route('orders')->with('success', 'Заявка на аренду #' . $order->id . ' успешно оформлена!');
}
}

