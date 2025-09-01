<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="bg-light">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #111;
            color: white;
            font-family: Arial, sans-serif;
        }

        .exam-container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
        }
    </style>


    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0">🎥 Virtual Attendance - PHP Questions</h2>
                        <p class="mb-0 small">Answer each question by recording a short video</p>
                    </div>
                    <!-- Progress Bar -->
                    <div class="progress mt-3 d-none" id="uploadProgress">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" style="width: 0%">0%</div>
                    </div>

                    <!-- Success/Error Messages -->
                    <div id="messageContainer"></div>
                    <div class="card-body p-4">

                        <form id="attendanceForm">

                            <!-- Question area -->
                            <div id="questionBox" class="text-center mb-4">
                                <h4 id="questionText" class="fw-bold">Question 1: Introduce Yourself</h4>
                            </div>

                            <!-- Video area -->
                            <div class="video-box text-center p-3 border rounded bg-light mb-3">
                                <video id="preview" autoplay muted playsinline class="rounded w-100 mb-2"
                                    height="250"></video>
                                <video id="recording" class="rounded w-100 mb-2 d-none" height="250" controls></video>

                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" id="startBtn" class="btn btn-success px-4"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Click to start recording your answer">
                                        <i class="bi bi-camera-video"></i> Start Recording
                                    </button>
                                    <button type="button" id="stopBtn" class="btn btn-danger px-4" disabled
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Click to stop and save your answer">
                                        <i class="bi bi-stop-circle"></i> Stop
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden inputs for storing videos -->
                            <input type="hidden" name="q1" id="q1">
                            <input type="hidden" name="q2" id="q2">
                            <input type="hidden" name="q3" id="q3">
                            <input type="hidden" name="q4" id="q4">
                            <input type="hidden" name="q5" id="q5">

                            <div class="text-center">
                                <button type="button" id="nextBtn"
                                    class="btn btn-primary px-5 py-2 rounded-pill shadow" disabled
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Move to the next question after recording">
                                    Next Question
                                </button>
                                <button type="submit" id="submitBtn"
                                    class="btn btn-success px-5 py-2 rounded-pill shadow d-none"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Submit all your recorded answers">
                                    Submit All Videos
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS (for tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let mediaRecorder;
        let recordedChunks = [];
        let currentQuestion = 1;
        let recordedVideos = []; // ✅ store blobs here

        const questions = [
            "Question 1: Introduce Yourself",
            "Question 2: What is PHP and why is it widely used?",
            "Question 3: Difference between GET and POST in PHP?",
            "Question 4: Explain Sessions and Cookies with an example.",
            "Question 5: How can you connect PHP with MySQL database?"
        ];

        // Access webcam
        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            })
            .then(stream => {
                preview.srcObject = stream;
                mediaRecorder = new MediaRecorder(stream);

                mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) {
                        recordedChunks.push(e.data);
                    }
                };

                mediaRecorder.onstop = () => {
                    const blob = new Blob(recordedChunks, {
                        type: "video/mp4"
                    }); // ✅ save as mp4
                    recordedChunks = [];
                    const url = URL.createObjectURL(blob);

                    recording.src = url;
                    recording.classList.remove("d-none");

                    // ✅ Store blob for current question
                    recordedVideos[currentQuestion - 1] = blob;

                    nextBtn.disabled = false;
                };
            });

        // Start Recording
        startBtn.addEventListener("click", () => {
            recording.classList.add("d-none");
            mediaRecorder.start();
            startBtn.disabled = true;
            stopBtn.disabled = false;
            nextBtn.disabled = true;
        });

        // Stop Recording
        stopBtn.addEventListener("click", () => {
            mediaRecorder.stop();
            startBtn.disabled = false;
            stopBtn.disabled = true;
        });

        // Next Question
        nextBtn.addEventListener("click", () => {
            if (currentQuestion < questions.length) {
                currentQuestion++;
                questionText.textContent = questions[currentQuestion - 1];
                recording.classList.add("d-none");
                nextBtn.disabled = true;

                if (currentQuestion === questions.length) {
                    nextBtn.classList.add("d-none");
                    submitBtn.classList.remove("d-none");
                }
            }
        });

        // Submit All
        document.getElementById("attendanceForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData();

            // ✅ Add each blob to FormData
            recordedVideos.forEach((videoBlob, index) => {
                if (videoBlob) {
                    formData.append("q" + (index + 1), videoBlob, "q" + (index + 1) + ".mp4");
                }
            });

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/video-answers", true);

            // CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            // Progress bar
            document.getElementById("uploadProgress").classList.remove("d-none");
            const progressBar = document.getElementById("progressBar");

            xhr.upload.addEventListener("progress", function(e) {
                if (e.lengthComputable) {
                    let percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + "%";
                    progressBar.textContent = percent + "%";
                }
            });

            xhr.onload = function() {
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (xhr.status === 200 && res.success) {
                        Swal.fire({
                            title: "✅ Success!",
                            text: res.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "/"; // ✅ redirect to home
                        });
                    } else {
                        Swal.fire("⚠️ Error", res.message || "Upload failed.", "error");
                    }
                } catch (err) {
                    Swal.fire("❌ Error", "Invalid server response", "error");
                }

                progressBar.style.width = "0%";
                progressBar.textContent = "0%";
                document.getElementById("uploadProgress").classList.add("d-none");
            };

            xhr.onerror = function() {
                Swal.fire("❌ Error", "Network error during upload.", "error");
                progressBar.style.width = "0%";
                progressBar.textContent = "0%";
                document.getElementById("uploadProgress").classList.add("d-none");
            };

            xhr.send(formData);
        });
    </script>
    <script>
        function goFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.log("Fullscreen blocked:", err);
                });
            }
        }

        // Try fullscreen on page load
        window.addEventListener("load", () => {
            goFullscreen();
        });

        // If user exits fullscreen, force back
        document.addEventListener("fullscreenchange", () => {
            if (!document.fullscreenElement) {
                goFullscreen();
            }
        });

        // Disable right-click
        document.addEventListener("contextmenu", e => e.preventDefault());

        // Disable refresh keys (F5, Ctrl+R)
        document.addEventListener("keydown", e => {
            if (e.key === "F5" || (e.ctrlKey && e.key === "r")) {
                e.preventDefault();
            }
        });

        // Detect tab switch / minimize
        window.addEventListener("blur", () => {
            alert("⚠️ You switched tabs! This will be reported.");
            // Optionally: auto-submit exam here
        });
    </script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 1rem;
        }

        .video-box {
            background: #f9fafb;
        }
    </style>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
