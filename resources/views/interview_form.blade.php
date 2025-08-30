<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
    <div class="container">
        <h2 class="my-4">Send Interview Invitation</h2>
        <form action="{{ route('send-interview-invitation') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="candidate_name" class="form-label">Candidate Name</label>
                <input type="text" class="form-control" id="candidate_name" name="candidate_name" required>
            </div>

            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>

            <div class="mb-3">
                <label for="interview_date" class="form-label">Interview Date</label>
                <input type="date" class="form-control" id="interview_date" name="interview_date" required>
            </div>

            <div class="mb-3">
                <label for="interview_time" class="form-label">Interview Time</label>
                <input type="time" class="form-control" id="interview_time" name="interview_time" required>
            </div>

            <div class="mb-3">
                <label for="interview_location" class="form-label">Interview Location</label>
                <input type="text" class="form-control" id="interview_location" name="interview_location" required>
            </div>

            <div class="mb-3">
                <label for="candidate_email" class="form-label">Candidate Email</label>
                <input type="email" class="form-control" id="candidate_email" name="candidate_email" required>
            </div>

            <button type="submit" class="btn btn-primary">Send Invitation</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
