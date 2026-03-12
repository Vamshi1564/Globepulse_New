<?php
// FILE: database/migrations/2026_03_11_add_country_id_columns.php
// Run: php artisan migrate

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add country_id to sellers (stores Country.country_id for correct dropdown)
        if (Schema::hasTable('sellers') && !Schema::hasColumn('sellers', 'country_id')) {
            Schema::table('sellers', function (Blueprint $table) {
                $table->unsignedBigInteger('country_id')->nullable()->after('country_code');
            });
        }

        // Add business_country_id to seller_details
        if (Schema::hasTable('seller_details') && !Schema::hasColumn('seller_details', 'business_country_id')) {
            Schema::table('seller_details', function (Blueprint $table) {
                $table->unsignedBigInteger('business_country_id')->nullable()->after('business_country_code');
            });
        }
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('business_country_id');
        });
    }
};