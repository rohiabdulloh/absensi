<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Setting;
class SettingMessagePage extends Component
{
    
    public $wa_message;
    public $wa_apikey;
    public $wa_secretkey;

    protected $settingKeys = [
        'wa_message',
        'wa_apikey',
        'wa_secretkey',
    ];

    protected $rules = [
        'wa_message' => 'required',
    ];

    public function mount()
    {
        foreach ($this->settingKeys as $key) {
            $this->{$key} = Setting::getValue($key);
        }
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-message-page')->layout('layouts.app');
    }

    public function save(){
        $this->validate();

        foreach ($this->settingKeys as $key) {
            Setting::setValue($key, $this->{$key});
        }

        $this->dispatch('show-message', msg:'Pengaturan berhasil disimpan');   
    }
}
