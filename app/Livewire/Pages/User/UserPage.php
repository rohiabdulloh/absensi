<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Role;
use Hash;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;   
use Barryvdh\DomPDF\Facade\Pdf as PDF; 

class UserPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    //Data untuk form    
    public $id;   
    public $name;
    public $email; 
    public $company; 
    public $username; 
    public $password; 
    public $confirm_password; 
    public $group; 

    public $groups = [];

    public function render()
    {
        if (!auth()->user()->hasPermissionTo('add_people') and !auth()->user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized'); 
        }

        $this->groups = Role::whereNot('name', 'superadmin')->get();
        return view('livewire.pages.user.user-page')->layout('layouts.app');
    }

    //Mengambil data edit ketika tombol edit diklik
    #[On('edit')]
    public function edit($id){
        $user = User::find($id);
        $this->isEdit = true;
        $this->fill([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "company" => $user->company,
            "username" => $user->username,
            "password" => null,
            "confirm_password" => null,
            "group" => $user->group,
        ]);
        $this->dispatch('open-modal');
    }

    //Menyimpan data form input/edit
    public function save(){
        //Menerapkan validasi data
        $this->validate([
            'name'  => 'required',
            'company'    => 'required',
            'username'     => 'required',
            'email'         => 'required|email'. ((!$this->isEdit) ? '|unique:users,email' : ''),
            'password'      => (!$this->isEdit) ? 'required' : '',
            'confirm_password'      => 'required_with:password|same:password',
            'group'          => 'required',
        ]);

        //Menyimpan data sesuai dengan status form (input/edit)
         if($this->isEdit) $user = User::find($this->id);
         else $user = new User;
                     
            $user->name     = $this->name;
            $user->email    = $this->email;
            $user->company  = $this->company;
            $user->username = $this->username;
            $user->group    = $this->group;
            if($this->password) $user->password = Hash::make($this->password);

         if($this->isEdit) $user->update();
         else $user->save();
         
         $user->assignRole($this->group);

         $this->isEdit = false;   
         //Merefresh tabel, menutup modal, menampilkan alert dan mereset form
         $this->dispatch('refresh')->to(UserTable::class);
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
        $user = User::find($this->idDelete);
        if($user){
            $user->delete();        
            $this->dispatch('refresh')->to(UserTable::class);
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
        $excel = new UserExport();
        return Excel::download($excel, 'Data User.xlsx');
    }

    public function exportPDF()
    {
        $users = User::all();
        $pdf = PDF::loadView('livewire.pages.user.user-pdf', compact('users'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Data User.pdf');
    }
}
