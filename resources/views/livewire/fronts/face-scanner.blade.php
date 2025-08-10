<div
    x-data="{
        video: null,
        canvas: null,
        faceDetected: false,
        faceChecked: false,

        init() {
            this.video = this.$refs.video;
            this.canvas = this.$refs.canvas;
            Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
            ]).then(() => console.log('Model face-api.js dimuat'));
        },

        startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    this.video.srcObject = stream;
                })
                .catch(error => {
                    alert('Tidak bisa mengakses kamera');
                    console.error(error);
                });
        },

        async captureSelfie() {
            const context = this.canvas.getContext('2d');
            this.canvas.width = this.video.videoWidth;
            this.canvas.height = this.video.videoHeight;
            context.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
            this.canvas.classList.remove('hidden');

            const detections = await faceapi.detectAllFaces(this.video);
            this.faceDetected = detections.length > 0;
            this.faceChecked = true;
        },

        submitSelfie() {
            const dataUrl = this.canvas.toDataURL('image/jpeg');
            @this.call('submitSelfie', dataUrl);
        }
    }"
    x-init="init()"
    class="p-4"
>
    <h2 class="text-xl font-bold mb-4">Presensi Selfie</h2>

    <!-- Video Kamera -->
    <div class="flex justify-center">
        <video x-ref="video" class="w-full max-w-sm border border-gray-300 rounded" autoplay muted playsinline></video>
    </div>

    <!-- Kontrol Tombol -->
    <div class="mt-4 flex justify-center gap-4">
        <button @click="startCamera" class="px-4 py-2 bg-blue-500 text-white rounded">Mulai Kamera</button>
        <button @click="captureSelfie" class="px-4 py-2 bg-green-500 text-white rounded">Ambil Selfie</button>
    </div>

    <!-- Notifikasi -->
    <div class="mt-4 text-center">
        <template x-if="faceDetected">
            <span class="text-green-600 font-semibold">Wajah terdeteksi!</span>
        </template>
        <template x-if="faceChecked && !faceDetected">
            <span class="text-red-600 font-semibold">Wajah tidak terdeteksi. Coba lagi.</span>
        </template>
    </div>

    <!-- Gambar Hasil Selfie -->
    <div class="mt-4 flex justify-center">
        <canvas x-ref="canvas" class="hidden"></canvas>
    </div>

    <!-- Form Kirim -->
    <div class="mt-4 flex justify-center">
        <button x-show="faceDetected" @click="submitSelfie" class="px-4 py-2 bg-indigo-600 text-white rounded">
            Kirim Presensi
        </button>
    </div>
</div>

<!-- Include face-api.js -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
@endpush
