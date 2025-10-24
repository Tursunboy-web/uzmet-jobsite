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
    Schema::create('candidates', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->year('birth_year')->nullable();
        $table->string('phone', 50);
        $table->string('email')->nullable();
        $table->string('position')->nullable();
        $table->text('experience')->nullable();
        $table->string('education')->nullable();
        $table->string('resume_path')->nullable();
        $table->enum('status', ['new','reviewed','interview','rejected','hired'])->default('new');
        $table->json('meta')->nullable(); // для дополнительных полей
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
        Schema::dropIfExists('candidates');
    }
};
