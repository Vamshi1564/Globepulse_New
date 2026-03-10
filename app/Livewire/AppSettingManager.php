<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AppSetting;

class AppSettingManager extends Component
{
    public $settings = [];
    public $editIndex = null;

    public function mount()
    {
        $this->settings = AppSetting::all()->toArray();
    }

    public function enableEdit($index)
    {
        $this->editIndex = $index;
    }

    public function cancelEdit()
    {
        $this->editIndex = null;
        $this->settings = AppSetting::all()->toArray(); // reset data
    }

    public function updateRow($index)
    {
        $data = $this->settings[$index];

        $setting = AppSetting::find($data['id']);

        if ($setting) {
            $setting->update([
                'AndroidAppVersion' => $data['AndroidAppVersion'],
                'IOSAppVersion' => $data['IOSAppVersion'],
                'AndroidAppVersionMandatory' => $data['AndroidAppVersionMandatory'],
                'IOSAppVersionMandatory' => $data['IOSAppVersionMandatory'],
                'AppMaintenance' => $data['AppMaintenance'],
            ]);
        }

        $this->editIndex = null;

        session()->flash('message', $data['title'] . ' updated successfully ✅');
    }

    public function render()
    {
        return view('livewire.app-setting-manager');
    }
}