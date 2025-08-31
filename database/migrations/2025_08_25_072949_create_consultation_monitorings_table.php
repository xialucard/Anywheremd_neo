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
        Schema::create('consultation_monitorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id');
            $table->time('time_given');
            $table->string('bpS', 255);
            $table->string('bpD', 255);
            $table->string('heart', 255);
            $table->string('o2', 255);
            $table->string('ap', 255);
            $table->string('vp', 255);
            $table->string('tmp', 255);
            $table->string('bfr', 255);
            $table->string('nss', 255);
            $table->string('ufr', 255);
            $table->string('ufv', 255);
            $table->text('remarks');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('active')->default(1);
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->index('consultation_id');
            $table->index('created_by');
            $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_monitorings');
    }
};
