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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('USR_ID', true);
            $table->string('USR_Nom', 50);
            $table->string('USR_Prenom', 100);
            $table->string('USR_Email', 50)->unique('USR_Email');
            $table->string('USR_Password');
            $table->integer('ROLE_ID')->index('ROLE_ID');
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
        Schema::dropIfExists('users');
    }
};
