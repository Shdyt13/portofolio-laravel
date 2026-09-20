<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     * Menambahkan kolom yang dipakai form/tabel Services yang baru,
     * hanya jika kolomnya belum ada di tabel `services`.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'description')) {
                $table->text('description')->nullable()->after('name');
            }

            if (! Schema::hasColumn('services', 'icon')) {
                $table->string('icon')->nullable()->after('description');
            }

            if (! Schema::hasColumn('services', 'display_order')) {
                $table->integer('display_order')->default(0)->after('fee');
            }

            if (! Schema::hasColumn('services', 'is_visible')) {
                $table->boolean('is_visible')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            foreach (['description', 'icon', 'display_order'] as $column) {
                if (Schema::hasColumn('services', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
