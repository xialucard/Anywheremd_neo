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
            $table->text('others')->nullable();
            $table->text('payment_mode')->nullable();
            $table->string('temp', 255)->nullable();
            $table->string('height', 255)->nullable();
            $table->string('weight', 255)->nullable();
            $table->integer('bpS')->nullable();
            $table->integer('bpD')->nullable();
            $table->string('bpOld', 255)->nullable();
            $table->integer('o2')->nullable();
            $table->string('heart', 255)->nullable();
            $table->string('resp', 255)->nullable();

            $table->string('post_temp', 255)->nullable();
            $table->string('post_height', 255)->nullable();
            $table->string('post_weight', 255)->nullable();
            $table->integer('post_bpS')->nullable();
            $table->integer('post_bpD')->nullable();
            $table->string('post_bpOld', 255)->nullable();
            $table->integer('post_o2')->nullable();
            $table->string('post_heart', 255)->nullable();
            $table->string('post_resp', 255)->nullable();

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

            $table->time('time_started')->nullable();
            $table->time('time_ended')->nullable();
            $table->string('machine_number', 255)->nullable();
            $table->string('dialyzer', 255)->nullable();
            $table->string('mac_use', 255)->nullable();
            $table->string('acid', 255)->nullable();
            $table->string('mac_add', 255)->nullable();
            $table->string('bfr', 255)->nullable();
            $table->string('dfr', 255)->nullable();
            $table->string('setup_prime', 255)->nullable();
            $table->string('safety_check', 255)->nullable();
            $table->string('residual_test', 255)->nullable();
            $table->string('dry_weight', 255)->nullable();
            $table->string('prev_post_hd_weight', 255)->nullable();
            $table->string('pre_hd_weight', 255)->nullable();
            $table->string('post_hd_weight', 255)->nullable();
            $table->string('ktv', 255)->nullable();
            $table->string('net_uf', 255)->nullable();
            $table->string('hd_duration', 255)->nullable();
            $table->string('frequency', 255)->nullable();
            $table->string('prime', 255)->nullable();
            $table->string('other_fluids', 255)->nullable();
            $table->string('total_uf_goal', 255)->nullable();
            $table->string('weight_loss', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->string('dose', 255)->nullable();
            $table->string('regular_dose', 255)->nullable();
            $table->string('low_dose', 255)->nullable();
            $table->string('lmwh', 255)->nullable();
            $table->string('flushing', 255)->nullable();
            $table->json('mental_status')->nullable();
            $table->string('ambulation_status', 255)->nullable();
            $table->string('subjective_complaints', 255)->nullable();
            $table->string('subjective_complaints_text', 255)->nullable();
            $table->json('pe_findings')->nullable();
            $table->string('pe_findings_ascites_text', 255)->nullable();
            $table->string('pe_findings_edema_text', 255)->nullable();
            $table->string('pe_findings_others_text', 255)->nullable();
            $table->json('post_mental_status')->nullable();
            $table->string('post_ambulation_status', 255)->nullable();
            $table->string('post_subjective_complaints', 255)->nullable();
            $table->string('post_subjective_complaints_text', 255)->nullable();
            $table->json('post_pe_findings')->nullable();
            $table->string('post_pe_findings_ascites_text', 255)->nullable();
            $table->string('post_pe_findings_edema_text', 255)->nullable();
            $table->string('post_pe_findings_others_text', 255)->nullable();
            $table->string('vaccess', 255)->nullable();
            $table->json('vaccess_detail')->nullable();
            $table->json('av_fistula_detail')->nullable();
            $table->string('needle_gauge', 255)->nullable();
            $table->string('number_commultation', 255)->nullable();
            $table->json('hd_catheter_detail')->nullable();
            $table->string('hd_catheter_remarks', 255)->nullable();
            $table->string('hd_catheter_hgb', 255)->nullable();
            $table->string('rml', 255)->nullable();
            $table->string('hepa', 255)->nullable();
            $table->string('iv_iron', 255)->nullable();
            $table->string('epo', 255)->nullable();
            $table->string('hd_vac', 255)->nullable();
            $table->text('hd_endorsement')->nullable();
            $table->string('rml', 255)->nullable();
            $table->string('hepa', 255)->nullable();
            $table->string('iv_iron', 255)->nullable();
            $table->string('epo', 255)->nullable();
            $table->string('hd_vac', 255)->nullable();
            $table->string('hd_endorsement', 255)->nullable();

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
            $table->unsignedBigInteger('vitals_updated_by')->nullable();
            $table->integer('active')->default(1);
            $table->foreign('consultation_parent_id')->references('id')->on('consultations');
            $table->foreign('advance_booking_id')->references('id')->on('consultations');
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->index('consultation_parent_id');
            $table->index('advance_booking_id');
            $table->index('clinic_id');
            $table->index('patient_id');
            $table->index('client_id');
            $table->index('doctor_id');
            $table->index('booking_type');
            // $table->index('icd_code');
            $table->index('status');
            $table->index('created_by');
            $table->index('updated_by');
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
