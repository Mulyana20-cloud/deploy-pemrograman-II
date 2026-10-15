<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('products', function (Blueprint $table) {


            $table->string('sku')
                ->unique()
                ->after('name');


            $table->integer('discount_price')
                ->nullable()
                ->after('price');


            $table->integer('weight')
                ->default(0)
                ->after('stock');


            $table->boolean('is_featured')
                ->default(false)
                ->after('image');



        });


    }



    public function down(): void
    {

        Schema::table('products', function (Blueprint $table) {


            $table->dropColumn([
                'sku',
                'discount_price',
                'weight',
                'is_featured',
                'status'
            ]);


        });


    }

};