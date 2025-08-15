<div class="flex flex-col justify-between max-w-4xl mx-auto px-4 py-8 bg-white dark:bg-gray-800 rounded-lg shadow-md"
    style="min-height: calc(100vh - 180px);">
    <div x-data="setData()" x-init="init()" class="flex-1 flex">

    <!-- Tampilan Kamera -->
    <div class="flex-1 flex flex-col" x-show="!photoTaken">
        <div class="flex flex-1 justify-center">
            <video x-ref="video" class="w-full h-full object-cover border border-gray-300 rounded" autoplay muted playsinline></video>
        </div>

        <div class="mt-4 flex justify-center">
            <x-button @click="captureSelfie" color="green">
                <x-fas-camera class="w-4 h-4 mr-2"/>
                Ambil Foto
            </x-button>
        </div>
    </div>

    <!-- Tampilan Foto -->
    <div class="flex-1 flex flex-col" x-show="photoTaken">
        <div class="mt-4 flex-1 flex justify-center">
            <canvas x-ref="canvas" class="w-full h-full object-cover border-2 border-gray-300"></canvas>
        </div>

        <div class="mt-4 flex justify-center gap-4">
            <x-button @click="retakePhoto" color="green">
                <x-fas-undo class="w-4 h-4 mr-2"/> Ulang
            </x-button>
            
            <x-button-primary wire:click="uploadImage"
                wire:loading.attr="disabled"
                wire:target="uploadImage">
                <x-fas-circle-notch wire:loading wire:target="uploadImage" class="w-4 h-4 mr-2 animate-spin"/>
                <x-fas-sign-out-alt wire:loading.remove wire:target="uploadImage" class="w-4 h-4 mr-2"/>
                Kirim Presensi
            </x-button-primary>
        </div>
    </div>

    </div>
</div>

@push('scripts')
<script>
function setData(){
    return {
        video: null,
        canvas: null,
        photoTaken: false,
        imageData: @entangle('imageData'),
        cameraStream: null, 
        init() {
            this.video = this.$refs.video;
            this.canvas = this.$refs.canvas;

            this.startCamera();

            window.addEventListener('before-wire-navigate', () => {
                this.cameraStream.getTracks().forEach(track => {
                    track.stop();
                });
                this.cameraStream = null;
            });
        },

        startCamera() {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user'} })
                .then(stream => {
                    this.cameraStream = stream;
                    this.video.srcObject = stream;
                })
                .catch(error => {
                    console.error('Tidak bisa mengakses kamera:', error);
                });
        },

        async captureSelfie() {
            const context = this.canvas.getContext('2d');
            this.canvas.width = this.video.videoWidth;
            this.canvas.height = this.video.videoHeight;
            context.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
            this.canvas.classList.remove('hidden');
            this.photoTaken = true;

            this.cameraStream.getTracks().forEach(track => {
                track.stop();
            });
            this.cameraStream = null;

            // Sembunyikan video saat foto diambil
            this.video.classList.add('hidden');
            this.imageData = this.canvas.toDataURL('image/jpeg');

        },

        retakePhoto() {
            this.photoTaken = false;
            this.canvas.classList.add('hidden');
            this.video.classList.remove('hidden');
            this.startCamera(); 
            this.imageData = '';
        }
    };
}
</script>
@endpush
