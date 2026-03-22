<?php
// Run from D:\xampp\htdocs\GFE\
// Removes ALL conflict markers and keeps BOTH versions merged

function resolveConflicts($file) {
    $content = file_get_contents($file);
    
    // Pattern: <<<<<<< HEAD ... ======= ... >>>>>>> hash
    // We want to keep BOTH sides (ours + theirs)
    $pattern = '/<<<<<<< HEAD\r?\n(.*?)=======\r?\n(.*?)>>>>>>> [a-f0-9]+\r?\n/s';
    
    $fixed = preg_replace_callback($pattern, function($matches) {
        $ours   = trim($matches[1]);
        $theirs = trim($matches[2]);
        
        // If ours is empty, keep theirs
        if (empty($ours)) return $theirs . "\n";
        
        // If theirs is empty, keep ours
        if (empty($theirs)) return $ours . "\n";
        
        // If they're different, keep both
        if ($ours === $theirs) return $ours . "\n";
        
        return $ours . "\n" . $theirs . "\n";
    }, $content);
    
    file_put_contents($file, $fixed);
    
    // Check if any conflict markers remain
    if (strpos(file_get_contents($file), '<<<<<<<') !== false) {
        echo "⚠️  Some conflicts remain in: $file — check manually" . PHP_EOL;
    } else {
        echo "✅ Fixed: $file" . PHP_EOL;
    }
}

resolveConflicts('routes/front.php');
resolveConflicts('routes/seller.php');

echo PHP_EOL . "Now run:" . PHP_EOL;
echo "git add routes/front.php routes/seller.php" . PHP_EOL;