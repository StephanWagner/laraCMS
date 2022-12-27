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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->index();
            $table->string('type', 64);
            $table->string('title', 191);
            $table->longText('content');
            $table->dateTime('date', 0)->index();
            $table->integer('order')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->bigInteger('created_by');
            $table->bigInteger('modified_by');
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
};
