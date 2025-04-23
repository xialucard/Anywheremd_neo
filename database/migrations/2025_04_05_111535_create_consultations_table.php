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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('bookingDate');
            $table->enum('booking_type', ['', 'Surgery', 'Laser', 'Diagnostics', 'Dialysis', 'Laboratory']);
            $table->text('procedure_details')->nullable();
            $table->text('complain')->nullable();
            $table->text('duration')->nullable();
            $table->text('payment_mode')->nullable();
            $table->float('temp', 8, 2)->nullable();
            $table->float('height', 8, 2)->nullable();
            $table->float('weight', 8, 2)->nullable();
            $table->integer('bpS')->nullable();
            $table->integer('bpD')->nullable();
            $table->integer('o2')->nullable();
            $table->integer('heart')->nullable();
            $table->string('arod_sphere', 255)->nullable();
            $table->float('arod_cylinder', 8, 2)->nullable();
            $table->integer('aros_axis')->nullable();
            $table->string('aros_sphere', 255)->nullable();
            $table->float('aros_cylinder', 8, 2)->nullable();
            $table->integer('arod_axis')->nullable();
            $table->string('vaod_num', 255)->nullable();
            $table->integer('vaod_den')->nullable();
            $table->string('vaodcor_num', 255)->nullable();
            $table->integer('vaodcor_den')->nullable();
            $table->string('vaos_num', 255)->nullable();
            $table->integer('vaos_den')->nullable();
            $table->string('vaoscor_num', 255)->nullable();
            $table->integer('vaoscor_den')->nullable();
            $table->string('pinod_num', 255)->nullable();
            $table->integer('pinod_den')->nullable();
            $table->string('pinodcor_num', 255)->nullable();
            $table->integer('pinodcor_den')->nullable();
            $table->string('pinos_num', 255)->nullable();
            $table->integer('pinos_den')->nullable();
            $table->string('pinoscor_num', 255)->nullable();
            $table->integer('pinoscor_den')->nullable();
            $table->string('jae_ou', 255)->nullable();
            $table->string('jae_od', 255)->nullable();
            $table->string('jae_os', 255)->nullable();
            $table->string('iopod', 255)->nullable();
            $table->string('iopos', 255)->nullable();
            $table->text('docNotesHPI')->nullable();
            $table->text('docNotesSubject')->nullable();
            $table->text('docNotes')->nullable();
            $table->text('icd_code')->nullable();
            $table->text('assessment')->nullable();
            $table->text('planMed')->nullable();
            $table->text('plan')->nullable();
            $table->text('planRem')->nullable();
            $table->enum('status', ['New', 'Confirmed', 'Done', 'Canceled'])->default('New');
            $table->text('prescription')->nullable();
            $table->text('findings')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('recommendations')->nullable();
            $table->date('con_date_ao')->nullable();
            $table->text('procedure_ao')->nullable();
            $table->string('anesthesia_type_ao')->nullable();
            $table->string('anesthesiologist_ao')->nullable();
            $table->text('admittingOrder')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('active')->default(1);
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
