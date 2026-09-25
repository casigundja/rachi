<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        if (Schema::getConnection()->getDriverName() === 'pgsql') {
            Schema::getConnection()->statement('ALTER TABLE sessions ENABLE ROW LEVEL SECURITY');
            Schema::getConnection()->statement('REVOKE ALL ON TABLE sessions FROM PUBLIC');
            foreach (['anon', 'authenticated'] as $role) {
                if (Schema::getConnection()->selectOne('SELECT 1 FROM pg_roles WHERE rolname = ?', [$role])) {
                    Schema::getConnection()->statement('REVOKE ALL ON TABLE sessions FROM "'.$role.'"');
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
