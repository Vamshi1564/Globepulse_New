<?php
// routes/web.php
// This file only loads the route groups split into multiple files.
require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
require __DIR__ . '/seller.php';
require __DIR__ . '/buyer.php';

// TEMPORARY DEBUG ROUTE — add to routes/web.php
// Visit: http://127.0.0.1:9000/test-sms-whatsapp
// DELETE after testing!

Route::get('/test-sms-whatsapp', function () {
    echo "<style>body{font-family:monospace;padding:30px;background:#0f172a;color:#e2e8f0;}
    .ok{color:#4ade80;}.err{color:#f87171;}.info{color:#60a5fa;}.warn{color:#fbbf24;}
    .box{background:#1e293b;padding:16px 20px;border-radius:10px;margin:12px 0;}</style>";
    echo "<h2 style='color:#f8fafc;'>📱 SMS + WhatsApp Debug</h2>";

    // ── CONFIG CLEAR REMINDER ─────────────────────────────────
    echo "<div class='box' style='border:2px solid #f59e0b;'>";
    echo "<b class='warn'>⚠️ After adding AISENSY_API_KEY to .env, run:</b><br><br>";
    echo "<code style='color:#4ade80;'>php artisan config:clear && php artisan cache:clear</code><br>";
    echo "<small style='color:#64748b;'>Otherwise Laravel reads cached .env and ignores new values</small>";
    echo "</div>";

    // ── CONFIG CHECK ──────────────────────────────────────────
    echo "<div class='box'>";
    echo "<b class='info'>CONFIG CHECK</b><br><br>";
    $aiKey = env('AISENSY_API_KEY');
    echo "AISENSY_API_KEY : " . ($aiKey ? '<span class="ok">✅ SET (' . strlen($aiKey) . ' chars)</span>' : '<span class="err">❌ NOT SET in .env</span>') . "<br>";
    echo "APP_URL         : " . env('APP_URL') . "<br>";
    echo "</div>";

    // ── CHANGE THESE ──────────────────────────────────────────
    $testPhone = '8904112290'; // ← YOUR 10-DIGIT PHONE (from your logs: 8904112290)
    $testName  = 'Test Seller';
    $testOtp   = '4321';

    // ── TEST SMS ──────────────────────────────────────────────
    echo "<div class='box'>";
    echo "<b class='info'>TEST SMS → {$testPhone}</b><br><br>";

    try {
        $apikey     = 'kfRGNGqkU0qC6NnFrutXww';
        $apisender  = 'GFEWRD';
        $dltid      = '1207175696767224408';
        $msg        = "Dear User, Your OTP for login to GFE Smart CRM is {$testOtp}. Valid for 30 minutes. Please do not share this OTP. Regards, gfegroup Team.";
        $encodedMsg = rawurlencode($msg);
        $url        = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey={$apikey}&senderid={$apisender}&channel=2&DCS=0&flashsms=0&number={$testPhone}&text={$encodedMsg}&route=1&dlttemplateid={$dltid}";

        echo "URL: <span style='color:#94a3b8;word-break:break-all;'>" . htmlspecialchars($url) . "</span><br><br>";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $result    = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            echo "<span class='err'>❌ CURL Error: " . htmlspecialchars($curlError) . "</span><br>";
        } else {
            echo "Response: <span class='ok'>" . htmlspecialchars($result) . "</span><br>";
            // smsgatewayhub returns JSON with "status" and "message"
            $decoded = json_decode($result, true);
            if (isset($decoded[0]['status'])) {
                $status = $decoded[0]['status'];
                if ($status === 'success' || $status === 'Success') {
                    echo "<span class='ok'>✅ SMS sent successfully!</span><br>";
                } else {
                    echo "<span class='err'>❌ SMS failed: " . ($decoded[0]['message'] ?? 'Unknown error') . "</span><br>";
                    echo "<span class='warn'>→ Check if DLT template ID matches your message exactly</span><br>";
                }
            }
        }
    } catch (\Exception $e) {
        echo "<span class='err'>❌ Exception: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    }
    echo "</div>";

    // ── TEST WHATSAPP — tries multiple param combinations ────
    echo "<div class='box'>";
    $waPhone = '91' . $testPhone;
    $apiKey  = env('AISENSY_API_KEY');
    echo "<b class='info'>TEST WHATSAPP → {$waPhone} (trying all param combinations)</b><br><br>";

    // Try each combination until one works
    $paramCombinations = [
        'Only OTP'              => [$testOtp],
        'Name + OTP'            => [$testName, $testOtp],
        'OTP + Name'            => [$testOtp, $testName],
        'OTP only (string)'     => [(string)$testOtp],
    ];

    foreach ($paramCombinations as $label => $params) {
        $payload = [
            'apiKey'         => $apiKey,
            'campaignName'   => 'b2botp',
            'destination'    => $waPhone,
            'userName'       => 'GFE',
            'templateParams' => $params,
            'source'         => 'new-landing-page form',
            'media'          => [],
            'buttons'        => [],
            'carouselCards'  => [],
            'location'       => [],
        ];

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post('https://backend.aisensy.com/campaign/t1/api/v2', $payload);

            $statusColor = $response->successful() ? 'ok' : 'err';
            echo "<b style='color:#fbbf24;'>[{$label}]</b> params=" . json_encode($params) . "<br>";
            echo "  → HTTP {$response->status()} : <span class='{$statusColor}'>" . htmlspecialchars($response->body()) . "</span><br><br>";

            if ($response->successful()) {
                echo "<span class='ok'>✅ SUCCESS with params: " . json_encode($params) . "</span><br>";
                echo "<span class='ok'>→ Use this combination in SellerSmsService.php</span><br>";
                break;
            }
        } catch (\Exception $e) {
            echo "  → <span class='err'>Exception: " . $e->getMessage() . "</span><br><br>";
        }
    }
    echo "</div>";

    // ── RECENT LOG ENTRIES ────────────────────────────────────
    echo "<div class='box'>";
    echo "<b class='info'>RECENT LOG (last 20 SellerSms lines)</b><br><br>";
    $logFile = storage_path('logs/laravel.log');
    if (file_exists($logFile)) {
        $lines = array_slice(file($logFile), -100);
        $found = 0;
        foreach ($lines as $line) {
            if (str_contains($line, 'SellerSms') || str_contains($line, 'AiSensy') || str_contains($line, 'smsgatewayhub')) {
                echo "<span style='font-size:.75rem;color:#" . (str_contains($line, 'ERROR') ? 'f87171' : (str_contains($line, 'warning') ? 'fbbf24' : '4ade80')) . ";'>"
                   . htmlspecialchars(trim($line)) . "</span><br>";
                $found++;
                if ($found >= 20) break;
            }
        }
        if ($found === 0) echo "<span style='color:#64748b;'>No SellerSms log entries found yet.</span>";
    }
    echo "</div>";
});