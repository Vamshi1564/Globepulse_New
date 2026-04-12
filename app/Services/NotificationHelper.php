<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class NotificationHelper
{
    public static function getSettings(): array
    {
        $row = DB::table('notification_settings')->first();

        if (!$row) return [];

        return json_decode($row->settings, true) ?? [];
    }

    public static function canSend($event, $type): bool
    {
        $settings = self::getSettings();

        return $settings[$event][$type] ?? false;
    }
}