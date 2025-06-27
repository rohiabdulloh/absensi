<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\User;
use Hash;
use Auth;

class UserProfile extends Component
{
    
    use WithFileUploads;
    //Data untuk form
    public $name;
    public $email; 
    public $password; 
    public $photo; 
    public $filePhoto;

    public function mount(){
        $user = Auth::user();
        $this->fill([ 
            "name" => $user->name,
            "email" => $user->email,
            "password" => null,
            "photo" => $user->photo,
        ]);
    }

    public function render()
    {
        return view('livewire.pages.user.user-profile')->layout('layouts.app');
    }

    //Menyimpan data form 
    public function save(){
        //Menerapkan validasi data
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        //upload gambar
        if($this->filePhoto){
            $namafile = time()."_".$this->filePhoto
                 ->getClientOriginalName();
            $this->filePhoto->storeAs('/user', $namafile, 'public');
         }else{
            $namafile = null;
         }

        //Menyimpan data
         $user = User::find(Auth::user()->id);
        
         $user->name = $this->name;
         $user->email = $this->email;
         if($this->password) $user->password = Hash::make($this->password);
         if($namafile) $user->photo = $namafile; 
         $user->update();

         $this->dispatch('refresh')->to('layout.navigation');
         $this->dispatch('show-message', msg:'Data berhasil disimpan');   
    }
}
