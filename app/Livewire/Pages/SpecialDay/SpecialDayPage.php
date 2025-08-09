<?php

namespace App\Livewire\Pages\SpecialDay;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SpecialDay;

class SpecialDayPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    // Form fields
    public $id;
    public $date;
    public $type = 'OFF';
    public $description;

    public function render()
    {
        return view('livewire.pages.special-day.special-day-page')->layout('layouts.app');
    }

    #[On('edit')]
    public function edit($id)
    {
        $data = SpecialDay::findOrFail($id);
        $this->isEdit = true;
        $this->fill([
            'id' => $data->id,
            'date' => $data->date->format('Y-m-d'),
            'type' => $data->type,
            'description' => $data->description,
        ]);
        $this->dispatch('open-modal');
    }

    public function save()
    {
        $this->validate([
            'date' => 'required|date|unique:special_days,date,' . $this->id,
            'type' => 'required|in:OFF,FM,HB',
            'description' => 'nullable|string|max:255',
        ]);

        $data = $this->isEdit ? SpecialDay::find($this->id) : new SpecialDay();
        $data->date = $this->date;
        $data->type = $this->type;
        $data->description = $this->description;
        $data->save();

        $this->isEdit = false;
        $this->dispatch('refresh')->to(SpecialDayTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data hari spesial berhasil disimpan');
        $this->resetForm();
    }

    #[On('delete')]
    public function confirm($id)
    {
        $this->idDelete = $id;
    }

    public function delete()
    {
        $data = SpecialDay::find($this->idDelete);
        if ($data) {
            $data->delete();
            $this->dispatch('refresh')->to(SpecialDayTable::class);
            $this->dispatch('show-message', msg: 'Data hari spesial berhasil dihapus');
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['id', 'date', 'type', 'description', 'isEdit', 'idDelete']);
    }
}
