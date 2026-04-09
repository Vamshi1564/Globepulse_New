<?php
// FILE: database/migrations/2024_01_01_000001_create_seller_kyc_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── Step 1: Detect sellers.id column type so we can match it exactly ──
        // errno:150 happens when seller_id type != sellers.id type
        $sellersIdType = DB::select("
            SELECT COLUMN_TYPE, IS_NULLABLE
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME   = 'sellers'
              AND COLUMN_NAME  = 'id'
        ");

        $colType = strtolower($sellersIdType[0]->COLUMN_TYPE ?? 'bigint unsigned');
        $isUnsigned = str_contains($colType, 'unsigned');
        $isBigInt   = str_contains($colType, 'bigint');

        Schema::create('seller_kyc', function (Blueprint $table) use ($isBigInt, $isUnsigned) {

            $table->id(); // always BIGINT UNSIGNED AUTO_INCREMENT for our own PK

            // ── Match sellers.id type exactly ────────────────────────────────
            if ($isBigInt && $isUnsigned) {
                $table->unsignedBigInteger('seller_id')->unique();
            } elseif ($isBigInt) {
                $table->bigInteger('seller_id')->unique();
            } elseif ($isUnsigned) {
                $table->unsignedInteger('seller_id')->unique();
            } else {
                $table->integer('seller_id')->unique();
            }

            // ── Account Holder ────────────────────────────────────────────────
            $table->string('account_holder_name', 200)->nullable();
            $table->enum('account_holder_type', ['individual', 'company'])->default('company');

            // ── Bank Account ──────────────────────────────────────────────────
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bank_ifsc_code', 20)->nullable();
            $table->string('bank_swift_code', 20)->nullable();
            $table->string('bank_name', 150)->nullable();
            $table->string('bank_branch_name', 150)->nullable();
            $table->string('bank_account_type', 30)->nullable();

            // ── GST / Tax ─────────────────────────────────────────────────────
            $table->string('gstin', 20)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('tan_number', 20)->nullable();
            $table->boolean('is_gst_registered')->default(false);

            // ── Beneficial Owner ──────────────────────────────────────────────
            $table->string('owner_full_name', 200)->nullable();
            $table->string('owner_dob', 20)->nullable();
            $table->string('owner_nationality', 100)->nullable();
            $table->string('owner_id_type', 50)->nullable();
            $table->string('owner_id_number', 100)->nullable();

            // ── Registered Address ────────────────────────────────────────────
            $table->string('registered_address_line1', 250)->nullable();
            $table->string('registered_address_line2', 250)->nullable();
            $table->string('registered_city', 100)->nullable();
            $table->string('registered_state', 100)->nullable();
            $table->string('registered_pincode', 20)->nullable();
            $table->string('registered_country', 100)->nullable()->default('India');

            // ── KYC Documents ─────────────────────────────────────────────────
            $table->string('doc_cancelled_cheque', 500)->nullable();
            $table->string('doc_cancelled_cheque_name', 200)->nullable();
            $table->string('doc_gst_certificate', 500)->nullable();
            $table->string('doc_gst_certificate_name', 200)->nullable();
            $table->string('doc_pan_card', 500)->nullable();
            $table->string('doc_pan_card_name', 200)->nullable();
            $table->string('doc_incorporation_cert', 500)->nullable();
            $table->string('doc_incorporation_cert_name', 200)->nullable();
            $table->string('doc_moa', 500)->nullable();
            $table->string('doc_moa_name', 200)->nullable();

            // ── CCAvenue (pre-wired for API integration) ──────────────────────
            $table->string('ccavenue_merchant_id', 100)->nullable();
            $table->string('ccavenue_reference_id', 100)->nullable();
            $table->enum('ccavenue_status', [
                'not_submitted', 'submitted', 'under_review',
                'approved', 'rejected', 'more_info_required',
            ])->default('not_submitted');
            $table->text('ccavenue_remarks')->nullable();
            $table->timestamp('ccavenue_submitted_at')->nullable();
            $table->timestamp('ccavenue_approved_at')->nullable();

            // ── Internal Review ───────────────────────────────────────────────
            $table->enum('internal_status', [
                'draft', 'submitted', 'approved', 'rejected', 'more_info',
            ])->default('draft');
            $table->text('admin_notes')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // ── Foreign key — added AFTER type is matched above ───────────────
            $table->foreign('seller_id')
                  ->references('id')
                  ->on('sellers')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_kyc');
    }
};