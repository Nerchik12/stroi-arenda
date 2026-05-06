<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentalDaysToCartTable extends Migration
{
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            if (!Schema::hasColumn('cart', 'rental_days')) {
                $table->unsignedInteger('rental_days')->default(1)->after('count');
            }
        });
    }

    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            if (Schema::hasColumn('cart', 'rental_days')) {
                $table->dropColumn('rental_days');
            }
        });
    }
}

