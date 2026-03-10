<?php

namespace App\Livewire\Seller;

use App\Models\Customer;
use App\Models\CustomerAddGroup;
use App\Models\Notification;
use App\Models\NotificationTrigger;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationList extends Component
{
    use WithPagination;
    public $customerId;

    public function mount()
    {
        // Retrieve the customer_id from the session
        $this->customerId = Session::get('id'); // Assumes customer_id is stored in session
    }

    // public function markAsRead($type, $id)
    // {
    //     if ($type === 'client') {
    //         $notification = Notification::where('id', $id)
    //             ->where('rel_id', $this->customerId)
    //             ->where('rel_type', 'client')
    //             ->first();

    //         if ($notification && $notification->read_status == 1) {
    //             $notification->update(['read_status' => 0]); // 0 = read, 1 = unread
    //         }
    //     }

    //     if ($type === 'trigger') {

    //         $trigger = NotificationTrigger::where('id', $id)
    //             ->where('read_status', 1)
    //             ->first();

    //         if ($trigger) {
    //             $trigger->update(['read_status' => 0]);
    //         }
    //     }

    //     // Optional redirect after marking as read
    //     return redirect()->route('show-notification',   ['type' => $type, 'id' => $id]);
    // }

    public function markAsRead($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('rel_id', $this->customerId)
            ->where('rel_type', 'client')
            ->first();

        if ($notification && $notification->read_status == 1) {
            $notification->update(['read_status' => 0]); // 0 = read, 1 = unread
        }

        // Optional redirect after marking as read
        return redirect()->route('show-notification', $notificationId);
    }

    public function render()
    {
        $customerId = $this->customerId;

        // $packageId = Customer::find($this->customerId)->package_id;

        $notifications = Notification::where('rel_id', $this->customerId)->where('rel_type', 'client')->orderBy('id', 'desc')->paginate(10);

        // $clientNotifications = Notification::where('rel_type', 'client')
        //     ->where('rel_id', $customerId)
        //     ->select(
        //         'id',
        //         'title',
        //         'message',
        //         'created_at',
        //         'read_status',
        //         DB::raw("'client' as type"),
        //         DB::raw("id as source_id")
        //     )
        //     ->get();

        // // 2️⃣ Group IDs by lead_id
        // $groupIds = DB::table('tblcustomer_groups')
        //     ->where('lead_id', $customerId)
        //     ->pluck('groupid');

        // // ❗ If no group found by lead_id
        // if ($groupIds->isEmpty()) {

        //     // customerId → customers.id
        //     $clientId = DB::table('tblleads')
        //         ->where('id', $customerId)
        //         ->value('client_id');

        //     if ($clientId) {
        //         // now match customer_id with client_id
        //         $groupIds = DB::table('tblcustomer_groups')
        //             ->where('customer_id', $clientId)
        //             ->pluck('groupid');
        //     }
        // }

        // // 3️⃣ Group / Trigger notifications
        // $groupNotifications = collect();

        // if ($groupIds->isNotEmpty()) {
        //     $groupNotifications = NotificationTrigger::whereIn('groupid', $groupIds)
        //         ->select(
        //             'id',
        //             'title',
        //             'description',
        //             'read_status',
        //             'created_at',
        //             DB::raw("'trigger' as type"),
        //             DB::raw("id as source_id")
        //         )
        //         ->get();
        // }

        // // 4️⃣ Merge + sort
        // $allNotifications = $clientNotifications
        //     ->merge($groupNotifications)
        //     ->sortByDesc('created_at')
        //     ->values();

        // // 5️⃣ Pagination
        // $perPage = 12;
        // $page = request()->get('page', 1);

        // $notifications = new LengthAwarePaginator(
        //     $allNotifications->forPage($page, $perPage),
        //     $allNotifications->count(),
        //     $perPage,
        //     $page,
        //     ['path' => request()->url()]
        // );

        return view('livewire.seller.notification-list', compact('notifications'));
    }
}
