<?php

namespace App;

trait StatusTrait
{
    public function getStatusName($status)
    {
        $statusNames = [
            1 => ['name' => 'Not Started', 'badge' => 'badge-phoenix-danger'],
            2 => ['name' => 'Hold', 'badge' => 'badge-phoenix-warning'],
            3 => ['name' => 'Client Side', 'badge' => 'badge-phoenix-info'],
            4 => ['name' => 'In Progress', 'badge' => 'badge-phoenix-primary'],
            5 => ['name' => 'Complete', 'badge' => 'badge-phoenix-success'],
            6 => ['name' => 'Deactive', 'badge' => 'badge-phoenix-black'],
        ];

        return $statusNames[$status] ?? ['name' => 'Unknown Status', 'badge' => 'badge-phoenix-default'];
    }
}
