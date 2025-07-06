<?php

namespace App\Livewire\Pages\Period;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Period;

class PeriodPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    // Form data
    public $id;
    public $year_start;
    public $year_end;
    public $is_active = 'N';

    public function render()
    {
        return view('livewire.pages.period.period-page')->layout('layouts.app');
    }

    #[On('edit')]
    public function edit($id)
    {
        $period = Period::find($id);
        $this->isEdit = true;
        $this->fill([
            'id' => $period->id,
            'year_start' => $period->year_start,
            'year_end' => $period->year_end,
            'is_active' => $period->is_active,
        ]);
        $this->dispatch('open-modal');
    }

    public function save()
    {
        $this->validate([
            'year_start' => 'required|integer|unique:periods,year_start,' . $this->id,
            'year_end' => 'required|integer|gt:year_start',
            'is_active' => 'required|in:Y,N',
        ]);

        if ($this->isEdit) {
            $period = Period::find($this->id);
        } else {
            $period = new Period();
        }

        $period->year_start = $this->year_start;
        $period->year_end = $this->year_end;
        $period->is_active = $this->is_active;
        $period->save();

        $this->isEdit = false;
        $this->dispatch('refresh')->to(PeriodTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data tahun ajaran berhasil disimpan');
        $this->resetForm();
    }

    #[On('confirm')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    public function delete()
    {
        $period = Period::find($this->idDelete);
        if ($period) {
            $period->delete();
            $this->dispatch('refresh')->to(PeriodTable::class);
            $this->dispatch('show-message', msg: 'Data tahun ajaran berhasil dihapus');
        }
    }


    #[On('activate')]
    public function activate($id)
    {
        Period::where('is_active', 'Y')->update(['is_active' => 'N']);

        $period = Period::find($id);
        $period->is_active = 'Y';
        $period->save();

        $this->dispatch('refresh')->to(PeriodTable::class);
        $this->dispatch('show-message', msg: 'Data tahun ajaran berhasil diaktifkan');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}
