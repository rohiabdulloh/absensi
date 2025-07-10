<div>
    @role('siswa')
        <livewire:fronts.home-page />
    @endrole

    @role('superadmin')
        @include('livewire.app.dashboard-admin')
    @endrole
</div>