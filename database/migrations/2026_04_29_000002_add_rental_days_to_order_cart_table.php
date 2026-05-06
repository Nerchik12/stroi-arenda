<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentalDaysToOrderCartTable extends Migration
{
    public function up()
    {
        Schema::table('order_cart', function (Blueprint $table) {
            if (!Schema::hasColumn('order_cart', 'rental_days')) {
                $table->unsignedInteger('rental_days')->default(1)->after('unit_price');
            }
        });
    }

    public function down()
    {
        Schema::table('order_cart', function (Blueprint $table) {
            if (Schema::hasColumn('order_cart', 'rental_days')) {
                $table->dropColumn('rental_days');
            }
        });
    }
}

