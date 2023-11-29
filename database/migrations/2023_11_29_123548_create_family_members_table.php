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
        Schema::create('family_members', function (Blueprint $table) {
            $table->integer('FAM_ID', true);
            $table->string('FAM_NOM', 20);
            $table->string('FAM_PRENOM', 50);
            $table->string('FAM_CONTACT', 11)->unique('FAM_CONTACT');
            $table->integer('USR_ID');
            $table->integer('CAR_ID')->nullable();
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
        Schema::dropIfExists('family_members');
    }
};
