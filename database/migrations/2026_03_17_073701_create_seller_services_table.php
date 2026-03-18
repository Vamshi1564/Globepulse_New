<?php
// FILE: database/migrations/xxxx_create_seller_services_table.php
// Run: php artisan make:migration create_seller_services_table
// Then replace up() and down() with the content below

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');            // FK to customers/sellers table
            $table->string('title', 255);
            $table->string('slug', 300)->unique();
            $table->text('description');                          // Rich text — what the service covers
            $table->string('service_type', 100);                 // e.g. Manufacturing, Consulting, IT, etc.
            $table->string('category_id')->nullable();            // reuse existing categories
            $table->string('subcategory_id')->nullable();
            $table->string('sub_subcategory_id')->nullable();

            // Pricing
            $table->enum('pricing_type', ['fixed', 'hourly', 'negotiable', 'quote_based'])->default('quote_based');
            $table->decimal('min_price', 15, 2)->nullable();
            $table->decimal('max_price', 15, 2)->nullable();
            $table->string('price_unit', 50)->nullable();         // per hour / per project / per piece

            // Service details
            $table->string('delivery_mode', 100)->nullable();     // Onsite / Remote / Both
            $table->string('turnaround_time', 100)->nullable();   // e.g. 3-5 Business Days
            $table->string('service_area', 300)->nullable();      // e.g. Pan India / Global / Mumbai
            $table->text('inclusions')->nullable();               // What's included
            $table->text('exclusions')->nullable();               // What's NOT included
            $table->string('certifications', 500)->nullable();    // ISO, etc.
            $table->string('languages', 200)->nullable();         // English, Hindi, etc.
            $table->string('experience_years', 50)->nullable();   // e.g. 10+ Years
            $table->integer('projects_completed')->nullable();    // social proof number

            // Media
            $table->string('cover_image', 500)->nullable();       // main service image
            $table->string('portfolio_images', 2000)->nullable(); // JSON array of image paths
            $table->string('video_url', 500)->nullable();

            // Terms
            $table->text('payment_terms')->nullable();
            $table->enum('sample_consultation', ['yes', 'no'])->default('no');  // free first call?
            $table->string('keywords', 500)->nullable();

            // Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'inactive'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('status');
            $table->index('service_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_services');
    }
};