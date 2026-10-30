<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('complaints_reports')) {
            return;
        }

        Schema::create('complaints_reports', function (Blueprint $table) {
            $table->id();
            $table->string('protocol', 32)->unique();
            $table->string('type', 20)->index(); // reclamacao | denuncia
            $table->boolean('is_anonymous')->default(false);
            $table->string('business_unit', 80)->nullable();
            $table->string('category', 120);
            $table->string('order_or_invoice_ref', 80)->nullable();
            $table->date('incident_date')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 40)->nullable();
            $table->string('nif_or_company', 160)->nullable();
            $table->string('subject', 255);
            $table->text('description');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->string('attachment_name', 255)->nullable();
            $table->string('attachment_mime', 100)->nullable();
            $table->string('status', 30)->default('recebido')->index(); // recebido | em_analise | respondido | encerrado
            $table->text('response_notes')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints_reports');
    }
};

