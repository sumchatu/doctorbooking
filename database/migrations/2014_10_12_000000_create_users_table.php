<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->integer('user_type')->default('1')->comment('1 for Admin 2 for Doctor 3 for User or Patient');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->text('address')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('department')->nullable();
            $table->decimal('fees',6,2)->nullable();
            $table->string('visiting_day')->nullable();
            $table->string('visiting_time')->nullable();
            $table->string('visiting_time_format')->nullable();
            $table->tinyInteger('status')->default(1);
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
}
