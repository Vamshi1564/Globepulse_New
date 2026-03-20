<?php

namespace App\Livewire\Seller;

use App\Models\Notification;
use App\Models\NotificationTrigger;
use Livewire\Component;

class ShowNotification extends Component
{

    public $notification;

    // public function mount($id)
    // {
    //     // Retrieve the notification by ID
    //     $this->notification = Notification::findOrFail($id);
    // }

    public function mount($type, $id)
    {
        // $this->type = $type;

        $this->notification = Notification::findOrFail($id);
        // if ($type === 'client') {
        //     $this->notification = Notification::findOrFail($id);
        // } else {
        //     $this->notification = NotificationTrigger::select(
        //         'id',
        //         'title',
        //         'description as message',
        //         'created_at'
        //     )->where('id', $id)->firstOrFail();
        // }
    }

    public function render()
    {

        return view('livewire.seller.show-notification');
    }
}
