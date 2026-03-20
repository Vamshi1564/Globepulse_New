<?php

// Add this inside the boot() method of app/Providers/AppServiceProvider.php
// OR put this entire file at app/helpers.php and add it to composer.json autoload

if (! function_exists('searchHighlight')) {
    /**
     * Wraps matched text with <span class="highlight"> for bold display.
     * Use with {!! searchHighlight($text, $query) !!} in Blade.
     */
    function searchHighlight(string $text, string $query): string
    {
        if (empty(trim($query))) {
            return e($text);
        }

        $escaped = e($text);
        $pattern = '/(' . preg_quote(e(trim($query)), '/') . ')/i';

        return preg_replace($pattern, '<span class="highlight">$1</span>', $escaped);
    }
}