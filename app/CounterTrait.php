<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

trait CounterTrait
{
    private function formatCount($count)
    {
        return $count >= 1000000000
        ? round($count / 1000000000, 1) . 'B'
        : ($count >= 1000000
            ? round($count / 1000000, 1) . 'M'
            : ($count >= 1000
                ? round($count / 1000, 1) . 'K'
                : $count));
    }
}