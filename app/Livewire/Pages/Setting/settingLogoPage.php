<?php
namespace App\Livewire\Pages\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

use App\Models\User;
class SettingLogoPage extends Component
{
    use WithFileUploads;
    
    public $logo;
    public $favicon;
    public $fileLogo;
    public $fileFavicon;

    public function mount()
    {
        $this->logo = asset('storage/setting/logo.png');
        $this->favicon = asset('storage/setting/favicon.png');
    }

    public function render()
    {
        return view('livewire.pages.setting.setting-logo-page')->layout('layouts.app');
    }

    public function save(){
        //Menerapkan validasi data
        $this->validate([
            'fileLogo' => 'nullable|mimes:png|max:2000',
            'fileFavicon' => 'nullable|mimes:png|max:1000',
        ]);

        //upload gambar
        if($this->fileLogo){
            $namalogo = "logo.png";
            $this->fileLogo->storeAs('/setting', $namalogo, 'public');
        }

        if($this->fileFavicon){
            $namafavicon = "favicon.png";
            $this->fileFavicon->storeAs('/setting', $namafavicon, 'public');
        }

         $this->dispatch('show-message', msg:'Data berhasil disimpan');   
    }
}
