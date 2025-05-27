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
            $table->string('profile_pic')->nullable();
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('user_type', ['Doctor', 'Clinic', 'Client', 'Internal'])->default('Internal');
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique();
            $table->string('designation')->nullable();
            $table->string('specialty')->nullable();
            $table->string('prc_pic')->nullable();
            $table->string('prc_number')->nullable();
            $table->date('prc_expiry')->nullable();
            $table->string('diploma_pic')->nullable();
            $table->string('medSchool')->nullable();
            $table->date('medgraddate')->nullable();
            $table->string('residencySchool')->nullable();
            $table->string('subSchool')->nullable();
            $table->text('hAffiliation')->nullable();
            $table->integer('bank_id')->nullable();
            $table->float('fee', 8, 2)->nullable();
            $table->integer('ave_consultation_duration')->nullable();
            $table->text('sub_header_1')->nullable();
            $table->text('sub_header_2')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->integer('approved')->default(0);
            $table->string('sig_pic')->nullable();
            $table->integer('active')->default(1);
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->index('user_type');
            $table->index('clinic_id');
            $table->index('created_by');
            $table->index('updated_by');
            
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
