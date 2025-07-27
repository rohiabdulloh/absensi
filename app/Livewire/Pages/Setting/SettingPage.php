<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Setting;
class SettingPage extends Component
{
    
    public $checkin_time;
    public $checkin_start;
    public $checkin_end;
    public $checkout_start;
    public $checkout_end;
    public $saturday_off;

    public function mount()
    {
        $this->checkin_time = Setting::getValue('checkin_time');
        $this->checkin_start = Setting::getValue('checkin_start');
        $this->checkin_end = Setting::getValue('checkin_end');
        $this->checkout_start = Setting::getValue('checkout_start');
        $this->checkout_end = Setting::getValue('checkout_end');
        $this->saturday_off = Setting::getValue('saturday_off');
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-page')->layout('layouts.app');
    }

    public function save(){
        Setting::setValue('checkin_time', $this->checkin_time);
        Setting::setValue('checkin_start', $this->checkin_start);
        Setting::setValue('checkin_end', $this->checkin_end);
        Setting::setValue('checkout_start', $this->checkout_start);
        Setting::setValue('checkout_end', $this->checkout_end);
        Setting::setValue('saturday_off', $this->saturday_off);
        $this->dispatch('show-message', msg:'Pengaturan berhasil disimpan');   
    }
}
