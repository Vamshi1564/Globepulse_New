<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlabIncentiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_slap_incentive')->insert([
            [
                'designation_id' => 2,
                'slab_amount' => 100000,
                'rel_type' => 'percentage',
                'incentive_percentage' => 2.5,
                'fix_amount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation_id' => 2,
                'slab_amount' => 250000,
                'rel_type' => 'percentage',
                'incentive_percentage' => 3.5,
                'fix_amount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation_id' => 2,
                'slab_amount' => 500000,
                'rel_type' => 'fixed',
                'incentive_percentage' => null,
                'fix_amount' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation_id' => 10,
                'slab_amount' => 1000000,
                'rel_type' => 'fixed',
                'incentive_percentage' => null,
                'fix_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation_id' => 11,
                'slab_amount' => 2000000,
                'rel_type' => 'fixed',
                'incentive_percentage' => null,
                'fix_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
