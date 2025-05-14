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
            $table->unsignedBigInteger('consultation_parent_id')->nullable();
            $table->unsignedBigInteger('advance_booking_id')->nullable();
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('doctor_id');
            $table->float('fee', 8, 2);
            $table->date('bookingDate');
            $table->enum('booking_type', ['', 'Surgery', 'Laser', 'Diagnostics', 'Dialysis', 'Laboratory'])->nullable();
            $table->text('procedure_details')->nullable();
            $table->text('complain')->nullable();
            $table->text('duration')->nullable();
            $table->text('payment_mode')->nullable();
            $table->string('temp', 255)->nullable();
            $table->string('height', 255)->nullable();
            $table->string('weight', 255)->nullable();
            $table->integer('bpS')->nullable();
            $table->integer('bpD')->nullable();
            $table->string('bpOld', 255)->nullable();
            $table->integer('o2')->nullable();
            $table->string('heart', 255)->nullable();
            $table->string('arod_sphere', 255)->nullable();
            $table->string('arod_cylinder', 255)->nullable();
            $table->string('aros_axis', 255)->nullable();
            $table->string('aros_sphere', 255)->nullable();
            $table->string('aros_cylinder', 255)->nullable();
            $table->string('arod_axis', 255)->nullable();
            $table->string('vaod_num', 255)->nullable();
            $table->string('vaod_den', 255)->nullable();
            $table->string('vaodcor_num', 255)->nullable();
            $table->string('vaodcor_den', 255)->nullable();
            $table->string('vaos_num', 255)->nullable();
            $table->string('vaos_den', 255)->nullable();
            $table->string('vaoscor_num', 255)->nullable();
            $table->string('vaoscor_den', 255)->nullable();
            $table->string('pinod_num', 255)->nullable();
            $table->string('pinod_den', 255)->nullable();
            $table->string('pinodcor_num', 255)->nullable();
            $table->string('pinodcor_den', 255)->nullable();
            $table->string('pinos_num', 255)->nullable();
            $table->string('pinos_den', 255)->nullable();
            $table->string('pinoscor_num', 255)->nullable();
            $table->string('pinoscor_den', 255)->nullable();
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
            $table->foreign('consultation_parent_id')->references('id')->on('consultations');
            $table->foreign('advance_booking_id')->references('id')->on('consultations');
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
