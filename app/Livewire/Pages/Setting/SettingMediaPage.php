<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Setting;
class SettingMediaPage extends Component
{
    
    public $delete_image_on;
    public $delete_image_limit;
    public $delete_image_time;

    protected $settingKeys = [
        'delete_image_on', 
        'delete_image_limit', 
        'delete_image_time', 
    ];

    public function mount()
    {
        foreach ($this->settingKeys as $key) {
            $this->{$key} = Setting::getValue($key);
        }
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-media-page')->layout('layouts.app');
    }

    public function save(){
        $this->validate();

        foreach ($this->settingKeys as $key) {
            Setting::setValue($key, $this->{$key});
        }

        $this->dispatch('show-message', msg:'Pengaturan berhasil disimpan');   
    }
}
