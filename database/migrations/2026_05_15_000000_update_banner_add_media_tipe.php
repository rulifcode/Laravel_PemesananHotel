<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom baru dulu (nullable agar tidak error di baris existing)
        Schema::table('banner', function (Blueprint $table) {
            $table->string('media')->nullable()->after('judul');
            $table->enum('tipe', ['image', 'gif', 'video'])
                  ->default('image')->after('media');
        });

        // 2. Copy data kolom gambar → media (semua dianggap image)
        DB::statement('UPDATE banner SET media = gambar, tipe = "image"');

        // 3. Baru hapus kolom lama setelah data aman
        Schema::table('banner', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('judul');
        });

        DB::statement('UPDATE banner SET gambar = media');

        Schema::table('banner', function (Blueprint $table) {
            $table->dropColumn(['media', 'tipe']);
        });
    }
};