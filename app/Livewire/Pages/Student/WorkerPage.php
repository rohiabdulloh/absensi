<?php

namespace App\Livewire\Pages\Worker;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Hash;

use App\Models\Worker;
use App\Models\Division;
use App\Models\Department;
use App\Models\Status;
use App\Models\Position;

use App\Imports\WorkerImport;
use App\Exports\WorkerFormat;
use App\Exports\WorkerExport;
use Maatwebsite\Excel\Facades\Excel;   
use Barryvdh\DomPDF\Facade\Pdf as PDF; 

class WorkerPage extends Component
{
    use WithFileUploads;

    public $idDelete;
    public $isEdit = false;
    public $transferId = [];

    //Data untuk form    
    public $id;   
    public $noid;
    public $name; 
    public $nik; 
    public $dob; 
    public $telp; 
    public $address; 
    public $department; 
    public $start_work_at; 
    public $bank_account; 
    public $account_name; 
    public $photo; 
    public $filePhoto;
    public $file_import;

    public $departments = [];

    public function render()
    {
        $this->departments    = Department::all();

        return view('livewire.pages.worker.worker-page')->layout('layouts.app');
    }

    //Mengambil data edit ketika tombol edit diklik
    #[On('edit')]
    public function edit($id){
        $worker = Worker::find($id);
        $this->isEdit = true;
        $this->fill([
            "id"            => $worker->id,
            "noid"          => $worker->noid,
            "name"          => $worker->name,
            "nik"           => $worker->nik,
            "dob"           => $worker->dob,
            "telp"          => $worker->telp,
            "address"       => $worker->address,
            "department"    => $worker->department_id,
            "start_work_at" => $worker->start_work_at,
            "bank_account"  => $worker->bank_account,
            "account_name"  => $worker->account_name,
            "photo"         => $worker->photo,
        ]);
        $this->dispatch('open-modal');
    }

    //Menyimpan data form input/edit
    public function save(){
        //Menerapkan validasi data
        $this->validate([
            'noid'          => 'required',
            'name'          => 'required',
            'nik'           => 'required',
            'dob'           => 'required',
            'department'    => 'required',
            'photo'         => 'nullable|mimes:jpeg,jpg,png|max:2000',
        ]);

        if($this->filePhoto){
            $namafile = time()."_".$this->noid."_". str_replace("'","",$this->name);
            $this->filePhoto->storeAs('public/worker', $namafile);
         }else{
            $namafile = null;
         }

        //Menyimpan data sesuai dengan status form (input/edit)
         if($this->isEdit) $worker = Worker::find($this->id);
         else $worker = new Worker;
                     
            $worker->noid           = $this->noid;
            $worker->name           = $this->name;
            $worker->nik            = $this->nik;
            $worker->dob            = $this->dob;
            $worker->telp           = $this->telp;
            $worker->address        = $this->address;
            $worker->department_id  = $this->department;
            $worker->start_work_at  = $this->start_work_at;
            $worker->bank_account   = $this->bank_account;
            $worker->account_name   = $this->account_name;
            if($namafile) $worker->photo          = $this->$namafile;

         if($this->isEdit) $worker->update();
         else $worker->save();
         
         $this->isEdit = false;   
         //Merefresh tabel, menutup modal, menampilkan alert dan mereset form
         $this->dispatch('refresh')->to(WorkerTable::class);
         $this->dispatch('close-modal');
         $this->dispatch('show-message', msg:'Data berhasil disimpan');   
         $this->resetForm();
    }

    //Menyimpan id yang akan dihapus
    #[On('confirm')]
    public function confirm($id){
        $this->idDelete = $id;
    }
    
    //Menghapus data sesuai id tersimpan
    public function delete()
    {
        $worker = Worker::find($this->idDelete);
        if($worker){
            $worker->delete();        
            $this->dispatch('refresh')->to(WorkerTable::class);
            $this->dispatch('show-message', msg:'Data berhasil dihapus');
        }
    }

    //Mereset form
    public function resetForm(){        
        $this->resetValidation();
        $this->reset();
    }

    public function exportExcel()
    {
        $excel = new WorkerExport();
        return Excel::download($excel, 'Data Worker.xlsx');
    }

    public function exportPDF()
    {
        $workers = Worker::all();
        $pdf = PDF::loadView('livewire.pages.worker.worker-pdf', compact('workers'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Data Worker.pdf');
    }

    public function downloadFormat(){
        $excel = new WorkerFormat();
        return Excel::download($excel, 'Format Data Worker.xlsx');
    }

    public function importWorker()
    {
        $validated = $this->validate([
            'file_import' => 'required'
        ]);

        $file = $this->file_import;  

        $worker = new WorkerImport();   
        Excel::import($worker, $file);
       
        $this->dispatch('refresh')->to(WorkerTable::class);
        $this->dispatch('close-import');
        
        $this->dispatch('show-message', msg:'Data pekerja berhasil di-import!');   
        $this->resetForm();
    }
}
