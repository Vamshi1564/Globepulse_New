<?php

namespace App\Helpers;

class SearchHelper
{
    /**
     * Wraps the matched portion of $text with a <span class="highlight">
     * so the typed query appears bold in the dropdown — exactly like Alibaba.
     *
     * Usage in Blade:
     *   {!! \App\Helpers\SearchHelper::highlight($item['name'], $searchTerm) !!}
     */
    public static function highlight(string $text, string $query): string
    {
        if (empty(trim($query))) {
            return e($text);
        }

        // Escape for safe HTML output, then bold the match
        $escaped = e($text);
        $pattern = '/(' . preg_quote(e(trim($query)), '/') . ')/i';

        return preg_replace($pattern, '<span class="highlight">$1</span>', $escaped);
    }
}