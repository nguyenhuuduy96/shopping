<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo_text')->nullable();
            $table->text('logo_image')->nullable();
            $table->text('url_banner1')->nullable();
            $table->text('url_banner2')->nullable();
            $table->text('url_banner3')->nullable();
            $table->text('address')->nullable();
            $table->text('email_contact')->nullable();
            $table->integer('choose_logo')->default(0);
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
        Schema::dropIfExists('settings');
    }
}
