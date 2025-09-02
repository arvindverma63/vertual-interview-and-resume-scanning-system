<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>
@include('partials.navbar')

<div class="container my-5">
    <h2 class="text-center mb-4">Career Responses</h2>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Current CTC</th>
                    <th>Expected CTC</th>
                    <th>Image</th>
                    <th>Resume</th>
                </tr>
            </thead>
            <tbody>
                @forelse($careers as $career)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $career->name }}</td>
                        <td>{{ $career->email }}</td>
                        <td>{{ $career->company }}</td>
                        <td>{{ $career->current_ctc }}</td>
                        <td>{{ $career->expected_ctc }}</td>
                        <td>
                            @if($career->image)
                                <a href="{{ asset('storage/'.$career->image) }}" download class="btn btn-sm btn-outline-primary">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if($career->resume)
                                <a href="{{ asset('storage/'.$career->resume) }}" download class="btn btn-sm btn-outline-success">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">No Resume</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No career responses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('partials.footer')
</body>
</html>
