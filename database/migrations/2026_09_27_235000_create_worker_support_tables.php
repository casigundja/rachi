<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('worker_attachments')) {
            Schema::create('worker_attachments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('service_request_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('name')->nullable();
                $table->string('mime_type')->nullable();
                $table->binary('content')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('worker_rate_limits')) {
            Schema::create('worker_rate_limits', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->integer('attempts')->default(0);
                $table->timestamp('expires_at')->nullable();
            });
        }

        if (!Schema::hasTable('worker_sessions')) {
            Schema::create('worker_sessions', function (Blueprint $table) {
                $table->string('token_hash')->primary();
                $table->unsignedBigInteger('user_id');
                $table->timestamp('expires_at')->nullable();
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_sessions');
        Schema::dropIfExists('worker_rate_limits');
        Schema::dropIfExists('worker_attachments');
    }
};
