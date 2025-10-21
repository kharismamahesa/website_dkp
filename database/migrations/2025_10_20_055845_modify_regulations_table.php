<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regulations', function (Blueprint $table) {
            $table->string('file_path')->nullable()->change();
            $table->string('external_link')->nullable()->after('file_path');
            $table->enum('source_type', ['file', 'link'])->after('external_link');
        });
    }

    public function down(): void
    {
        Schema::table('regulations', function (Blueprint $table) {
            $table->string('file_path')->nullable(false)->change();
            $table->dropColumn(['external_link', 'source_type']);
        });
    }
};
