<div>
    @role('siswa')
        <livewire:fronts.home-page />
    @endrole
    
    @role('guru')
        <livewire:teachers.home-page />
    @endrole

    @role('superadmin')
        @include('livewire.app.dashboard-admin')
    @endrole
</div>