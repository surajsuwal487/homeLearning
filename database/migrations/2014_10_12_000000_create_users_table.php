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
            $table->id();
            $table->string('name');

            $table->string('slug')->unique();
            $table->double('phone_no')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->default('active');
            $table->string('image')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('operational_address')->nullable();
            $table->string('established_year')->nullable();
            $table->string('business')->nullable();
            $table->string('owner_info')->nullable();
            $table->string('main_products')->nullable();
            $table->string('website')->nullable();
            $table->string('file')->nullable();
            $table->Enum('vendor_status',['pending','approved','unapproved'])->nullable();
            $table->string('facebook_id')->unique()->nullable();
            $table->LongText('facebook_token')->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->LongText('google_token')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
