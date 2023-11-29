<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->integer('CAR_ID', true);
            $table->string('CAR_Color', 20);
            $table->string('CAR_Immat', 50)->unique('CAR_Immat');
            $table->string('CAR_Marque', 50);
            $table->string('CAR_Modele', 50);
            $table->integer('CAR_Year')->default(0);
            $table->string('CAR_TypeMoteur', 20);
            $table->integer('USR_ID')->index('USR_ID');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
