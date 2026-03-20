<?php
// FILE: database/migrations/xxxx_add_b2b_fields_to_tbl_products_table.php
// Replace old failed migration file content with this

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Add new columns to tbl_products ──────────────────
        Schema::table('tbl_products', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_products', 'brand_name'))
                $table->string('brand_name', 200)->nullable()->after('title');

            if (!Schema::hasColumn('tbl_products', 'unit'))
                $table->string('unit', 50)->nullable()->default('Piece')->after('min_order');

            if (!Schema::hasColumn('tbl_products', 'price_type'))
                $table->enum('price_type',['range','fixed','negotiable','quote'])->default('range')->after('unit');

            if (!Schema::hasColumn('tbl_products', 'supply_ability'))
                $table->string('supply_ability', 200)->nullable()->after('price_type');

            if (!Schema::hasColumn('tbl_products', 'lead_time'))
                $table->string('lead_time', 100)->nullable()->after('supply_ability');

            if (!Schema::hasColumn('tbl_products', 'packaging_details'))
                $table->text('packaging_details')->nullable()->after('lead_time');

            if (!Schema::hasColumn('tbl_products', 'certifications'))
                $table->string('certifications', 500)->nullable()->after('packaging_details');

            if (!Schema::hasColumn('tbl_products', 'sample_available'))
                $table->enum('sample_available',['yes','no'])->default('no')->after('certifications');

            if (!Schema::hasColumn('tbl_products', 'sample_price'))
                $table->decimal('sample_price', 10, 2)->nullable()->after('sample_available');

            if (!Schema::hasColumn('tbl_products', 'payment_terms'))
                $table->string('payment_terms', 300)->nullable()->after('sample_price');

            if (!Schema::hasColumn('tbl_products', 'port_of_dispatch'))
                $table->string('port_of_dispatch', 200)->nullable()->after('payment_terms');

            if (!Schema::hasColumn('tbl_products', 'country_of_origin'))
                $table->string('country_of_origin', 100)->nullable()->default('India')->after('port_of_dispatch');

            if (!Schema::hasColumn('tbl_products', 'product_video_url'))
                $table->string('product_video_url', 500)->nullable()->after('country_of_origin');

            if (!Schema::hasColumn('tbl_products', 'keywords'))
                $table->string('keywords', 500)->nullable()->after('product_video_url');

            if (!Schema::hasColumn('tbl_products', 'seller_id'))
                $table->char('seller_id', 36)->nullable()->after('customer_id');

            if (!Schema::hasColumn('tbl_products', 'rejection_reason'))
                $table->text('rejection_reason')->nullable()->after('seller_id');
        });

        // ── Create product_documents table ───────────────────
        if (!Schema::hasTable('tbl_product_documents')) {
            Schema::create('tbl_product_documents', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('customer_id');
                $table->string('label', 100);         // Brochure, Spec Sheet, etc.
                $table->string('file_path', 500);
                $table->string('file_ext', 10)->nullable();
                $table->timestamps();
                $table->index('product_id');
                $table->index('customer_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $cols = ['brand_name','unit','price_type','supply_ability','lead_time',
                     'packaging_details','certifications','sample_available','sample_price',
                     'payment_terms','port_of_dispatch','country_of_origin',
                     'product_video_url','keywords','seller_id','rejection_reason'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('tbl_products', $col))
                    $table->dropColumn($col);
            }
        });
        Schema::dropIfExists('tbl_product_documents');
    }
};