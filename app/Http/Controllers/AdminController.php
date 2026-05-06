<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Главная страница админ-панели
     */
    public function index()
    {
        // Статистика
        $totalUsers = DB::table('users')->count();
        $totalAdmins = DB::table('users')->where('role', 'admin')->count();
        $totalOrders = DB::table('orders')->count();
        $totalProducts = DB::table('products')->count();
        $totalRevenue = DB::table('orders')->sum('total_amount');

        // Последние заказы
        $recentOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->orderBy('orders.created_at', 'desc')
            ->limit(10)
            ->get();

        // Последние пользователи
        $recentUsers = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalOrders',
            'totalProducts',
            'totalRevenue',
            'recentOrders',
            'recentUsers'
        ));
    }

    /**
     * Управление пользователями
     */
    public function users()
    {
        $users = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Выдать роль администратора
     */
    public function makeAdmin($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Пользователь не найден.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя изменить свою собственную роль.');
        }

        DB::table('users')->where('id', $id)->update(['role' => 'admin']);

        return redirect()->back()->with('success', "Пользователь {$user->name} теперь администратор.");
    }

    /**
     * Снять роль администратора
     */
    public function makeUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Пользователь не найден.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя изменить свою собственную роль.');
        }

        // Проверка: должен остаться хотя бы один админ
        $adminCount = DB::table('users')->where('role', 'admin')->count();
        if ($adminCount <= 1) {
            return redirect()->back()->with('error', 'Должен остаться хотя бы один администратор.');
        }

        DB::table('users')->where('id', $id)->update(['role' => 'user']);

        return redirect()->back()->with('success', "Пользователь {$user->name} теперь обычный пользователь.");
    }

    /**
     * Сбросить пароль пользователя
     */
    public function resetPassword($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Пользователь не найден.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя сбросить свой собственный пароль.');
        }

        // Устанавливаем временный пароль: admin123
        $temporaryPassword = 'admin123';
        DB::table('users')->where('id', $id)->update(['password' => Hash::make($temporaryPassword)]);

        return redirect()->back()->with('success', "Пароль пользователя {$user->name} сброшен. Временный пароль: {$temporaryPassword}");
    }

    /**
     * Удалить пользователя
     */
    public function deleteUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Пользователь не найден.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя удалить самого себя.');
        }

        try {
            // Отключаем внешние ключи временно
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            // Удаляем связанные записи
            DB::table('orders')->where('user_id', $id)->delete();
            DB::table('cart')->where('user_id', $id)->delete();
            DB::table('reviews')->where('user_id', $id)->delete();
            DB::table('feedback')->where('user_id', $id)->delete();

            // Удаляем пользователя
            DB::table('users')->where('id', $id)->delete();

            // Включаем внешние ключи обратно
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            return redirect()->route('admin.users')->with('success', "Пользователь {$user->name} удалён.");
        } catch (\Exception $e) {
            // Включаем внешние ключи обратно в случае ошибки
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            return redirect()->back()->with('error', 'Ошибка при удалении: ' . $e->getMessage());
        }
    }

    /**
     * Управление отзывами на товарах
     */
    public function reviews()
    {
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select(
                'reviews.*',
                'users.name as user_name',
                'users.email as user_email',
                'products.name as product_name',
                'products.id as product_id'
            )
            ->orderBy('reviews.created_at', 'desc')
            ->paginate(20);

        return view('admin.reviews', compact('reviews'));
    }

    /**
     * Удалить отзыв
     */
    public function deleteReview($id)
    {
        DB::table('reviews')->where('id', $id)->delete();

        return redirect()->route('admin.reviews')->with('success', 'Отзыв удалён.');
    }

    /**
     * Управление заказами
     */
    public function orders()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.email as user_email')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(20);

        return view('admin.orders', compact('orders'));
    }

    /**
     * Изменить статус заказа
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Заказ не найден.');
        }

        $request->validate([
            'status' => 'required|in:active,pending,completed,cancelled',
        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', "Статус заказа #{$order->id} обновлён.");
    }

    /**
     * Управление товарами (список всех товаров)
     */
    public function products()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.created_at', 'desc')
            ->paginate(20);

        return view('admin.products', compact('products'));
    }

    /**
     * Форма редактирования товара
     */
    public function editProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Товар не найден.');
        }

        // Получаем название категории
        $categoryName = DB::table('categories')->where('id', $product->category_id)->value('name');

        $categories = DB::table('categories')->orderBy('name')->get();

        return view('admin.edit-product', compact('product', 'categories', 'categoryName'));
    }

    /**
     * Обновление товара
     */
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'price' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'year' => 'required|integer|min:2000|max:'.(date('Y')+1),
            'country' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'in_stock' => 'required|integer|min:0'
        ]);

        // Получаем текущий товар
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Товар не найден.');
        }

        // Обработка изображения
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $typeImg = $img->extension();
            $uniqName = \Illuminate\Support\Str::uuid();
            $nameImg = $uniqName . '.' . $typeImg;

            $folderPath = public_path('img');

            if (!\Illuminate\Support\Facades\File::exists($folderPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($folderPath, 0755, true);
            }

            $img->move($folderPath, $nameImg);
            $imagePath = '/public/img/' . $nameImg;
        }

        // Получаем название категории
        $category = DB::table('categories')
            ->where('id', $request->category_id)
            ->value('name');

        // Обновляем товар
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $category,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'country' => $request->country,
            'model' => $request->model,
            'in_stock' => $request->in_stock,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products')->with('success', 'Товар успешно обновлён!');
    }

    /**
     * Удалить товар
     */
    public function deleteProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.products')->with('success', 'Товар удалён.');
    }
}
