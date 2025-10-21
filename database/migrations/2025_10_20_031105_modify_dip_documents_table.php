<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dip_documents', function (Blueprint $table) {
            $table->string('document')->nullable()->change();
            $table->string('external_link')->nullable()->after('document');
            $table->enum('source_type', ['file', 'link'])->after('external_link');
        });
    }

    public function down(): void
    {
        Schema::table('dip_documents', function (Blueprint $table) {
            $table->string('document')->nullable(false)->change();
            $table->dropColumn(['external_link', 'source_type']);
        });
    }
};
