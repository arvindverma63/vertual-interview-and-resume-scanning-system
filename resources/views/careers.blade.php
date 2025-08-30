<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
@include('partials.navbar')

<div class="container my-5">
    <h2 class="text-center mb-4">Career Application</h2>
    <div class="card shadow-lg p-4 rounded-3">

        <!-- ✅ Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- ❌ Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="careerForm" action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <!-- Current Company -->
                <div class="col-md-6">
                    <label for="company" class="form-label">Current Company</label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}" class="form-control">
                </div>

                <!-- Current CTC -->
                <div class="col-md-3">
                    <label for="current_ctc" class="form-label">Current CTC</label>
                    <input type="number" id="current_ctc" name="current_ctc" value="{{ old('current_ctc') }}" class="form-control" step="0.01">
                </div>

                <!-- Expected CTC -->
                <div class="col-md-3">
                    <label for="expected_ctc" class="form-label">Expected CTC</label>
                    <input type="number" id="expected_ctc" name="expected_ctc" value="{{ old('expected_ctc') }}" class="form-control" step="0.01">
                </div>

                <!-- Camera Capture -->
                <div class="col-12">
                    <label class="form-label">Capture Image *</label>
                    <div class="text-center">
                        <video id="camera" autoplay playsinline class="border rounded mb-2 d-none" width="300"></video><br>
                        <button type="button" class="btn btn-sm btn-primary" id="startCameraBtn">Start Camera</button>
                        <button type="button" class="btn btn-sm btn-success d-none" id="captureBtn">Capture</button>
                        <canvas id="canvas" class="d-none"></canvas>
                        <input type="hidden" name="image" id="capturedImage">
                        <div id="preview" class="mt-2"></div>
                    </div>
                </div>

                <!-- Resume Upload -->
                <div class="col-12">
                    <label for="resume" class="form-label">Upload Resume *</label>
                    <input type="file" id="resume" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Submit</button>
            </div>
        </form>
    </div>
</div>

@include('partials.footer')

<script>
    const video = document.getElementById('camera');
    const canvas = document.getElementById('canvas');
    const startBtn = document.getElementById('startCameraBtn');
    const captureBtn = document.getElementById('captureBtn');
    const preview = document.getElementById('preview');
    const capturedImageInput = document.getElementById('capturedImage');
    let stream;

    // Start Camera only on click
    startBtn.addEventListener('click', async () => {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
            video.classList.remove('d-none');
            captureBtn.classList.remove('d-none');
            startBtn.classList.add('d-none');
        } catch (err) {
            alert("Camera access denied: " + err);
        }
    });

    // Capture Image
    captureBtn.addEventListener('click', () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0);
        const dataURL = canvas.toDataURL("image/png");
        capturedImageInput.value = dataURL;

        // Show Preview
        preview.innerHTML = `<img src="${dataURL}" class="img-thumbnail mt-2" width="200">`;

        // Stop camera after capture
        stream.getTracks().forEach(track => track.stop());
        video.classList.add('d-none');
        captureBtn.classList.add('d-none');
        startBtn.classList.remove('d-none');
    });
</script>
</body>
</html>
