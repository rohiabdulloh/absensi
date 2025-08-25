<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Setting;
class SettingLocationPage extends Component
{
        
    public $absen_latitude;
    public $absen_longitude;
    public $absen_radius;
    public $absen_location;

    protected $settingKeys = [
        'absen_latitude',
        'absen_longitude',
        'absen_radius',
        'absen_location',
    ];

    protected $rules = [
        'absen_latitude' => 'required|numeric',
        'absen_longitude' => 'required|numeric',
        'absen_radius' => 'required|integer|min:10',
    ];

    public function mount()
    {
        foreach ($this->settingKeys as $key) {
            $this->{$key} = Setting::getValue($key);
        }
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-location-page')->layout('layouts.app');
    }

    public function save(){
        $this->validate();

        foreach ($this->settingKeys as $key) {
            Setting::setValue($key, $this->{$key});
        }

        $this->dispatch('show-message', msg:'Pengaturan berhasil disimpan');   
    }
}
