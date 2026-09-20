<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     * Menambahkan kolom `image` di tabel `certificates` untuk menyimpan
     * path file gambar sertifikat yang diunggah lewat FileUpload.
     */
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            if (! Schema::hasColumn('certificates', 'image')) {
                $table->string('image')->nullable()->after('date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            if (Schema::hasColumn('certificates', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
