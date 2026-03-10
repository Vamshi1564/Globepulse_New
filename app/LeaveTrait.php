<?php

namespace App;

use App\Models\LeaveManagement;
use App\Models\MonthlyLeaves;
use App\Models\Staff;
use Carbon\Carbon;

trait LeaveTrait
{

    public function updateAvailableLeave($staffId, $leaveId)
    {

        // $month = Carbon::now()->format('F'); // e.g., June
        // $year = Carbon::now()->year;
        // Count total leave days (supporting multi-day leave)
        // $usedLeave = LeaveManagement::where('staffid', $staffId)
        //     ->where('approved_status', 2)
        //     ->sum('leave_count');
        $leave = LeaveManagement::find($leaveId);

        // $usedLeave = LeaveManagement::where('staffid', $staffId)
        //     ->where('approved_status', 2)
        //     ->whereMonth('start_date', Carbon::now()->month)
        //     ->whereYear('start_date', $year)
        //     ->value('leave_count');
        // ->sum(function ($leave) {
        //     return Carbon::parse($leave->start_date)->diffInDays(Carbon::parse($leave->end_date)) + 1;
        // });





        $month = Carbon::parse($leave->start_date)->format('F');
        $year = Carbon::parse($leave->start_date)->year;

        $usedLeave = $leave->leave_count;

        $monthlyLeave = MonthlyLeaves::firstOrNew([
            'staffid' => $staffId,
            'month' => $month,
            'year' => $year,
        ]);

        // $monthlyLeave->used_leave = $usedLeave;
        $monthlyLeave->used_leave += $usedLeave;
        // $monthlyLeave->balance = max(0, ($monthlyLeave->balance ?? 0) - $usedLeave);
        // $monthlyLeave->balance = max(0, $monthlyLeave->balance - $usedLeave);


        //      if (!is_null($monthlyLeave->system_add)) {
        //     $monthlyLeave->balance = $monthlyLeave->system_add - $usedLeave;
        // }

        $monthlyLeave->save();






        // $start = Carbon::parse($leave->start_date)->startOfDay();
        // $end = Carbon::parse($leave->end_date)->startOfDay();
        // $totalCountAdded = 0;
        // // For half or single day
        // if ($leave->day_type === 'half_day' || $leave->day_type === 'single_day') {
        //     $month = $start->format('F');
        //     $year = $start->year;
        //     $this->addLeaveToMonth($staffId, $month, $year, $leave->leave_count);
        //     $totalCountAdded = $leave->leave_count;
        // }

        // // For multiple day leave
        // if ($leave->day_type === 'multiple_days') {
        //     $current = $start->copy();
        //     while ($current <= $end) {
        //         $month = $current->format('F');
        //         $year = $current->year;

        //         // Count how many days are in this month only
        //         $daysInMonth = 0;

        //         while ($current <= $end && $current->format('F') === $month) {
        //             $daysInMonth++;
        //             $current->addDay();
        //         }

        //         $this->addLeaveToMonth($staffId, $month, $year, $daysInMonth);
        //         $totalCountAdded += $daysInMonth;
        //     }
        // }

        // Get total leave for this staff

        $currentAvailable = Staff::where('staffid', $staffId)->value('available_leave');


        // Calculate available leave
        $availableLeave = max(0, $currentAvailable - $usedLeave);


        // Update available leave in staff table
        Staff::where('staffid', $staffId)->update([
            // 'used_leave' => $usedLeave,
            'available_leave' => $availableLeave,
        ]);
        // }
    }

    // private function addLeaveToMonth($staffId, $month, $year, $count)
    // {
    //     $monthly = MonthlyLeaves::firstOrNew([
    //         'staffid' => $staffId,
    //         'month' => $month,
    //         'year' => $year,
    //     ]);

    //     $monthly->used_leave += $count;
    //     $monthly->save();
    // }
}