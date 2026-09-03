<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'days')) {
                $table->unsignedInteger('days')->nullable()->after('price');
            }
            if (! Schema::hasColumn('products', 'nights')) {
                $table->unsignedInteger('nights')->nullable()->after('days');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['days', 'nights']);
        });
    }
};
