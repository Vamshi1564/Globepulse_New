<?php
// routes/web.php
// This file only loads the route groups split into multiple files.
require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
require __DIR__ . '/seller.php';
require __DIR__ . '/buyer.php';

Route::get('/debug-country', function () {
 
    echo "<pre style='font-family:monospace;padding:20px;background:#0f172a;color:#e2e8f0;'>";
    echo "<b style='color:#38bdf8;'>SELLERS TABLE — COLUMN STRUCTURE</b>\n\n";
 
    // Use default mysql connection (gfe_global)
    try {
        $columns = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM sellers");
        foreach ($columns as $col) {
            $isCountry = in_array($col->Field, ['country_id', 'country_code']);
            $color = $isCountry ? "color:#f59e0b;font-weight:bold;" : "color:#e2e8f0;";
            echo "<span style='{$color}'>";
            echo str_pad($col->Field, 25) . " | " . str_pad($col->Type, 20) . " | NULL=" . str_pad($col->Null,3) . " | Default=" . $col->Default;
            echo "</span>\n";
        }
 
        // Conclusion
        $cols = collect($columns);
        $cidCol  = $cols->firstWhere('Field', 'country_id');
        $codeCol = $cols->firstWhere('Field', 'country_code');
 
        echo "\n<b style='color:#38bdf8;'>CONCLUSION:</b>\n";
        if ($cidCol) {
            echo "country_id   type: <b style='color:#f59e0b;'>{$cidCol->Type}</b>\n";
        }
        if ($codeCol) {
            echo "country_code type: <b style='color:#f59e0b;'>{$codeCol->Type}</b>\n";
        }
 
    } catch (\Exception $e) {
        echo "<span style='color:#f87171;'>Error: " . $e->getMessage() . "</span>\n";
        echo "Try DB connection name from your .env DB_CONNECTION value\n";
    }
 
    echo "</pre>";
});