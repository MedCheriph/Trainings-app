<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_formation');
            $table->foreign('id_formation')->references('id')->on('formations');
            $table->date('date_lancement');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->integer('pourcentage')->nullable();
            $table->decimal('prix_c')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
