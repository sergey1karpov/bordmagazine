<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role_id')->default(0);

            $table->string('city', 20)->nullable();
            $table->string('country', 20)->nullable();

            $table->string('insta', 100)->nullable()->unique();
            $table->string('facebook', 100)->nullable()->unique();
            $table->string('vk', 100)->nullable()->unique();

            $table->string('about', 500)->nullable();
            $table->string('img')->nullable();
            $table->string('banner')->nullable();
            $table->string('tel', 15)->unique()->nullable();
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
}
