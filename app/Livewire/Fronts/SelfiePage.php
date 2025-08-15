<?php
namespace App\Livewire\Fronts;

use Livewire\Component;
use Carbon\Carbon;
use Auth;
use Storage;

use App\Models\Period;
class SelfiePage extends Component
{
    public $type;
    public $imageData;
    public $year;

    public function mount()
    {
        $this->setYear();

    }

    public function render()
    {
        return view('livewire.fronts.selfie-page')->layout('layouts.app');
    }

    public function uploadImage()
    {
        if (!$this->imageData) {
            session()->flash('error', 'Gambar tidak ditemukan.');
            return;
        }

        $data = explode(',', $this->imageData);
        $imageContent = base64_decode($data[1]);

        $filename = 'selfie_' . now()->timestamp . '.jpg';
        Storage::disk('public')->put("selfies/{$filename}", $imageContent);

        if($this->type=='checkin') HomePage::handleCheckin($filename, $this->year);
        if($this->type=='checkout') HomePage::handleCHeckout($filename, $this->year);

        return $this->redirect('/', navigate:true);
    }

    public function setYear(){
        $activePeriod = Period::where('is_active', 'Y')->first();
        $this->year = $activePeriod ? $activePeriod->year_start : date('Y');
    }
}
