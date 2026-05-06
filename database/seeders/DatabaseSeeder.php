<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем администратора
        DB::table('users')->insert([
            'name' => 'Администратор',
            'email' => 'admin@stroimaster.ru',
            'password' => bcrypt('admin123'),
            'phone' => '+7 (495) 765-43-21',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Создаем категории
        $categories = [
            ['name' => 'Ручной инструмент', 'slug' => 'ruchnoy-instrument', 'icon_class' => 'bi-hammer'],
            ['name' => 'Электроинструмент', 'slug' => 'elektroinstrument', 'icon_class' => 'bi-lightning-charge'],
            ['name' => 'Измерительное оборудование', 'slug' => 'izmeritelnoe-oborudovanie', 'icon_class' => 'bi-rulers'],
            ['name' => 'Садовая техника', 'slug' => 'sadovaya-tekhnika', 'icon_class' => 'bi-tree'],
            ['name' => 'Силовое оборудование', 'slug' => 'silovoe-oborudovanie', 'icon_class' => 'bi-battery-charging'],
            ['name' => 'Строительное оборудование', 'slug' => 'stroitelnoe-oborudovanie', 'icon_class' => 'bi-cone-striped'],
            ['name' => 'Клининг и уход', 'slug' => 'klining-i-uhod', 'icon_class' => 'bi-bucket'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'icon_class' => $cat['icon_class'],
                'description' => "Категория: {$cat['name']}",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Создаем товары
        $products = [
            [
                'name' => 'Дрель-шуруповёрт аккумуляторная',
                'category' => 'Электроинструмент',
                'price' => 1200,
                'old_price' => 1600,
                'description' => 'Профессиональная дрель-шуруповёрт с двумя аккумуляторами. Мощность 18В, крутящий момент 50 Нм. Цена за сутки аренды.',
                'country' => 'Германия',
                'model' => 'DX-1800',
                'year' => 2024,
                'in_stock' => 25,
                'is_new' => true,
            ],
            [
                'name' => 'Перфоратор профессиональный',
                'category' => 'Электроинструмент',
                'price' => 1800,
                'old_price' => 2400,
                'description' => 'Мощный перфоратор для тяжёлых работ. Энергия удара 3.2 Дж, три режима работы. Цена за сутки аренды.',
                'country' => 'Япония',
                'model' => 'RH-3200',
                'year' => 2024,
                'in_stock' => 15,
                'is_new' => true,
            ],
            [
                'name' => 'Лазерный нивелир 360°',
                'category' => 'Измерительное оборудование',
                'price' => 1100,
                'old_price' => 1500,
                'description' => 'Лазерный нивелир для точной разметки стен, пола и потолка. Цена за сутки аренды.',
                'country' => 'Россия',
                'model' => 'LV-360',
                'year' => 2025,
                'in_stock' => 30,
                'is_new' => false,
            ],
            [
                'name' => 'Виброплита 90 кг',
                'category' => 'Строительное оборудование',
                'price' => 3500,
                'old_price' => 4200,
                'description' => 'Виброплита для уплотнения грунта и щебня. Цена за сутки аренды.',
                'country' => 'Россия',
                'model' => 'VP-90',
                'year' => 2025,
                'in_stock' => 8,
                'is_new' => false,
            ],
            [
                'name' => 'Краскопульт электрический',
                'category' => 'Электроинструмент',
                'price' => 900,
                'old_price' => 1200,
                'description' => 'Электрический краскопульт для равномерного нанесения лакокрасочных материалов. Цена за сутки аренды.',
                'country' => 'Финляндия',
                'model' => 'SP-900',
                'year' => 2024,
                'in_stock' => 40,
                'is_new' => true,
            ],
            [
                'name' => 'Шлифмашина эксцентриковая',
                'category' => 'Электроинструмент',
                'price' => 950,
                'old_price' => 1300,
                'description' => 'Эксцентриковая шлифмашина для дерева и металла. Цена за сутки аренды.',
                'country' => 'Бельгия',
                'model' => 'RS-300',
                'year' => 2024,
                'in_stock' => 20,
                'is_new' => false,
            ],
            [
                'name' => 'Дизельный генератор 6 кВт',
                'category' => 'Силовое оборудование',
                'price' => 4200,
                'old_price' => 5000,
                'description' => 'Генератор для питания инструмента и освещения на объекте. Цена за сутки аренды.',
                'country' => 'Россия',
                'model' => 'DG-6000',
                'year' => 2025,
                'in_stock' => 10,
                'is_new' => false,
            ],
            [
                'name' => 'Мойка высокого давления',
                'category' => 'Клининг и уход',
                'price' => 1400,
                'old_price' => 1800,
                'description' => 'Мойка высокого давления для фасадов и уборки техники. Цена за сутки аренды.',
                'country' => 'Китай',
                'model' => 'HPW-150',
                'year' => 2024,
                'in_stock' => 20,
                'is_new' => true,
            ],
            [
                'name' => 'Лестница-стремянка 7 ступеней',
                'category' => 'Строительное оборудование',
                'price' => 700,
                'old_price' => 950,
                'description' => 'Алюминиевая стремянка для высотных работ. Цена за сутки аренды.',
                'country' => 'Польша',
                'model' => 'Ladder-7',
                'year' => 2024,
                'in_stock' => 30,
                'is_new' => false,
            ],
            [
                'name' => 'Кусторез аккумуляторный',
                'category' => 'Садовая техника',
                'price' => 1000,
                'old_price' => 1400,
                'description' => 'Кусторез для подрезки живых изгородей и кустарников. Цена за сутки аренды.',
                'country' => 'Китай',
                'model' => 'HT-20V',
                'year' => 2024,
                'in_stock' => 18,
                'is_new' => true,
            ],
        ];

        foreach ($products as $prod) {
            $category = DB::table('categories')->where('name', $prod['category'])->first();

            DB::table('products')->insert([
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'description' => $prod['description'],
                'full_description' => $prod['description'] . "\n\nПолное описание товара с подробными характеристиками и преимуществами.",
                'price' => $prod['price'],
                'old_price' => $prod['old_price'],
                'stock_quantity' => $prod['in_stock'],
                'category_id' => $category?->id,
                'country' => $prod['country'],
                'model' => $prod['model'],
                'year' => $prod['year'],
                'is_new' => $prod['is_new'],
                'is_bestseller' => rand(0, 1),
                'is_active' => true,
                'image' => 'img/products/' . Str::slug($prod['name']) . '.jpg',
                'rating' => rand(40, 50) / 10,
                'reviews_count' => rand(0, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
