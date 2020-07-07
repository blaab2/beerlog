<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beer_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        $beer = new \App\BeerType();
        $beer->name = 'Beer';
        $beer->price = 1.2;
        $beer->save();

        $beer = new \App\BeerType();
        $beer->name = 'Spezi';
        $beer->price = 1.2;
        $beer->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beer_types');
    }
}
