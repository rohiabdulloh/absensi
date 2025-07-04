<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Personalia</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Siswa</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Siswa
        <x-slot:filter>
            <div class="w-80">
                <x-select model="classroom_id" live="true">
                    <option value="0">Semua Kelas</option> 
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}"> {{ $class->name }} </option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-80">
                <x-select model="period_id" live="true">
                    <option value="0">Semua Periode</option> 
                    @foreach($periods as $period)
                        <option value="{{ $period->id }}"> {{ $period->name }} </option>
                    @endforeach
                </x-select>
            </div>
        </x-slot>

        @if(auth()->user()->hasAnyPermission(['modify_students', 'add_students']))
        <x-slot:action>
            @can('add_students') 
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Siswa</span>
            </x-dropdown-link>
            @endcan

            @can('modify_students')
            <x-dropdown-link @click="isImportOpen = true">
                <x-fas-file-import class="h-4 w-4 mr-2"/> 
                <span>Import Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportExcel">
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportPDF">
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF</span>
            </x-dropdown-link>
            @endcan
        </x-slot>
        @endif
    </x-page-header>

    <x-card class="min-h-full">
        <div class="w-full overflow-x-auto">
            <livewire:pages.student.student-table :classroom="$classroom_id" :period="$period_id" :key="time()"/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-2/3">
                <x-slot name="header">
                    <h3>{{ ($isEdit) ? "Edit" : "Tambah" }} Data Siswa</h3>
                </x-slot>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex flex-col space-y-2">    
                        <x-input inline="false" label="NIS*" model="nis"/>  
                        <x-input inline="false" label="Nama Siswa*" model="name"/>  
                        <x-input inline="false" label="No. Telepon" model="telp"/>  
                        <x-input inline="false" label="Alamat" model="address"/>  
                        <x-select inline="false" label="Jenis Kelamin*" model="gender">  
                            <option value="M">Laki-laki</option>
                            <option value="F">Perempuan</option>
                        </x-select>
                        <x-input-date inline="false" label="Tahun Masuk*" model="year_entry"/>  
                    </div>
                    <div class="flex flex-col space-y-2">    
                        <x-select inline="false" label="Kelas*" model="classroom">  
                            <option value=""></option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </x-select>
                        <x-select inline="false" label="Periode*" model="period">  
                            <option value=""></option>
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}">{{ $period->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input inline="false" label="Nama Orang Tua" model="parent_name"/>  
                        <x-input inline="false" label="Email Orang Tua" model="parent_email"/>
                        <x-dropzone accept="image/*" label="Foto Siswa" model="filePhoto" fileurl="{{$photo}}" inline="false" height="80">
                            @if($filePhoto)
                                <img src="{{ $filePhoto->temporaryUrl() }}" width="150">    
                            @elseif($photo) 
                                <img src="/storage/student/{{$photo}}" width="150">
                            @endif 
                        </x-dropzone>
                    </div>
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
