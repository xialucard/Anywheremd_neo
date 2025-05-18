<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('profile_pic')->nullable();
            $table->string('f_name', 255);
            $table->string('m_name', 255)->nullable();
            $table->string('l_name', 255);
            $table->string('name', 255);
            $table->string('relation', 255)->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdate')->nullable();
            $table->string('phil_num', 255)->nullable();
            $table->string('hmo', 255)->nullable();
            $table->string('hmo_num', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('mobile_no', 255)->nullable();
            $table->enum('patient_type', ['Private', 'In House'])->nullable();
            $table->enum('patient_sub_type', ['Non Walk-in', 'Walk-in','Walk-in Social Media', 'Walk-in Mainstream Media', 'Walk-in Signage', 'Walk-in Referral From'])->nullable();
            $table->string('referral_from', 255)->nullable();
            $table->text('med_history')->nullable();
            $table->json('pastMedicalHistory')->nullable();
            $table->text('pastMedicalHistoryComma')->nullable();
            $table->text('pastMedicalHistoryCancer')->nullable();
            $table->text('pastMedicalHistoryOthers')->nullable();
            $table->text('pastSurgicalHistory')->nullable();
            $table->json('pastFamilyHistory')->nullable();
            $table->text('pastFamilyHistoryComma')->nullable();
            $table->text('pastFamilyHistoryCancer')->nullable();
            $table->text('pastFamilyHistoryOthers')->nullable();
            $table->text('pastMedication')->nullable();
            $table->text('presentMedication')->nullable();
            $table->json('allergies')->nullable();
            $table->text('allergiesComma')->nullable();
            $table->text('allergiesFood')->nullable();
            $table->text('allergiesMedicine')->nullable();
            $table->text('allergiesOthers')->nullable();
            $table->text('vaccination')->nullable();
            $table->text('medHistoryOthers')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('active')->default(1);
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->index('client_id');
            $table->index('created_by');
            $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
