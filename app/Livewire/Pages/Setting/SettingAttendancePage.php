<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Setting;
class SettingAttendancePage extends Component
{
    
    public $checkin_time;
    public $checkin_start;
    public $checkin_end;
    public $checkout_start;
    public $checkout_end;
    public $saturday_off;

    public $wa_message;
    public $wa_apikey;
    public $wa_secretkey;

    public $absen_latitude;
    public $absen_longitude;
    public $absen_radius;
    public $absen_location;
    
    public $button_activator = 1;
    public $present_method = 1;

    public $delete_image_on;
    public $delete_image_limit;
    public $delete_image_time;

    protected $settingKeys = [
        'checkin_time',
        'checkin_start',
        'checkin_end',
        'checkout_start',
        'checkout_end',
        'saturday_off',
        'wa_message',
        'wa_apikey',
        'wa_secretkey',
        'absen_latitude',
        'absen_longitude',
        'absen_radius',
        'absen_location',
        'button_activator',   
        'present_method', 
        'delete_image_on', 
        'delete_image_limit', 
        'delete_image_time', 
    ];

    protected $rules = [
        'checkin_time' => 'required',
        'checkin_start' => 'required',
        'checkin_end' => 'required',
        'checkout_start' => 'required',
        'checkout_end' => 'required',
        'wa_message' => 'required',
        'absen_latitude' => 'required|numeric',
        'absen_longitude' => 'required|numeric',
        'absen_radius' => 'required|integer|min:10',
        'button_activator' => 'required|in:0,1,2',  
        'present_method' => 'required|in:0,1,2', 
    ];

    public function mount()
    {
        foreach ($this->settingKeys as $key) {
            $this->{$key} = Setting::getValue($key);
        }
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-attendance-page')->layout('layouts.app');
    }

    public function save(){
        $this->validate();

        foreach ($this->settingKeys as $key) {
            Setting::setValue($key, $this->{$key});
        }

        $this->dispatch('show-message', msg:'Pengaturan berhasil disimpan');   
    }
}
