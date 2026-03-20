<?php
// FILE: database/migrations/2026_03_09_100000_add_must_change_password_to_sellers.php
//
// Since you created all 7 tables manually in phpMyAdmin,
// this migration ONLY adds must_change_password if it doesn't exist yet.
// All other tables are skipped — no errors.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only adds column if it doesn't already exist
        if (Schema::hasTable('sellers') && !Schema::hasColumn('sellers', 'must_change_password')) {
            Schema::table('sellers', function (Blueprint $table) {
                $table->tinyInteger('must_change_password')
                      ->default(1)
                      ->after('is_active');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sellers', 'must_change_password')) {
            Schema::table('sellers', function (Blueprint $table) {
                $table->dropColumn('must_change_password');
            });
        }
    }
};