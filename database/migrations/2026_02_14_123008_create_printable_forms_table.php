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
        Schema::create('printable_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id');
            $table->text('anesthesia_type_ot')->nullable();
            $table->text('anesthesiologist_ot')->nullable();
            $table->text('operative_tech')->nullable();
            $table->text('after_proc')->nullable();
            $table->text('things_watch_out')->nullable();
            $table->text('things_avoid')->nullable();
            $table->text('wound_care')->nullable();
            $table->text('medication')->nullable();
            $table->text('room')->nullable();
            $table->text('dilate')->nullable();
            $table->text('constrict')->nullable();
            $table->text('intake_blood_thinner')->nullable();
            $table->text('intake_maintenance_meds')->nullable();
            $table->text('additional_orders')->nullable();
            
            $table->string('i_temp', 255)->nullable();
            $table->integer('i_bpS')->nullable();
            $table->integer('i_bpD')->nullable();
            $table->integer('i_o2')->nullable();
            $table->text('i_remarks')->nullable();
            $table->text('c_nurse')->nullable();

            $table->string('o_temp', 255)->nullable();
            $table->integer('o_bpS')->nullable();
            $table->integer('o_bpD')->nullable();
            $table->integer('o_o2')->nullable();
            $table->text('o_remarks')->nullable();
            $table->text('r_nurse')->nullable();
            
            $table->time('time_admitted', $precision = 0)->nullable();
            $table->time('time_discharged', $precision = 0)->nullable();

            $table->json('datetime_nurse_notes')->nullable();

            $table->text('pre_op_diagnosis')->nullable();
            $table->text('post_op_diagnosis')->nullable();
            $table->text('procedure_performed')->nullable();
            $table->text('intraoperative_findings')->nullable();
            $table->text('intraoperative_course')->nullable();
            $table->text('complication_specify')->nullable();
            $table->text('blood_loss')->nullable();
            $table->text('specimen_sent')->nullable();
            $table->text('specimen_sent_remarks')->nullable();
            $table->text('post_operative_condition')->nullable();
            $table->text('post_operative_condition_remarks')->nullable();
            $table->text('medication_given_recovery')->nullable();
            $table->text('discharge_medication')->nullable();
            $table->integer('avoid_days')->nullable();
            $table->text('diet')->nullable();
            $table->text('diet_remarks')->nullable();

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
        Schema::dropIfExists('printable_forms');
    }
};
