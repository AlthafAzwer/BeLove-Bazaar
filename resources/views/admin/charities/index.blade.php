@extends('layouts.admin')

@section('content')

<style>
    h1 {
        font-size: 2.5rem;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
    }

    .table-container {
        margin-top: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        text-align: left;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: bold;
    }

    .table td img {
        max-width: 50px;
        height: auto;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 5px;
        border: none;
        color: white;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    .modal.active {
        visibility: visible;
        opacity: 1;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h5 {
        margin: 0;
        font-size: 1.25rem;
    }

    .modal-header button {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: #333;
        cursor: pointer;
    }

    .modal-body textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        resize: none;
        margin-bottom: 20px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .alert {
        padding: 15px;
        background-color: #d4edda;
        color: #155724;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        border: 1px solid #c3e6cb;
    }
</style>

<div class="container mt-5">
    <h1>Manage Charity Requests</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Logo</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Certification</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($charityRequests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->address }}</td>
                        <td>{{ $request->phone }}</td>
                        <td>
                            @if($request->logo)
                                <img src="{{ asset('storage/' . $request->logo) }}" alt="Logo">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $request->description }}</td>
                        <td>{{ $request->quantity }}</td>
                        <td>
                            @if($request->certification)
                                <a href="{{ asset('storage/' . $request->certification) }}" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.charities.approve', $request->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this request?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <button class="btn btn-danger" onclick="showRejectModal('{{ $request->id }}')">Reject</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No pending charity requests.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($charityRequests->hasPages())
            <div class="pagination justify-content-center">
                {{ $charityRequests->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="modal">
    <div class="modal-content">
        <form id="rejectForm" method="POST">
            @csrf
            <div class="modal-header">
                <h5>Reject Charity Request</h5>
                <button type="button" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <label for="reason">Reason for Rejection:</label>
                <textarea name="reason" id="reason" rows="4" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showRejectModal(id) {
        const form = document.getElementById('rejectForm');
        form.action = `/admin/charities/${id}/reject`;
        document.getElementById('rejectModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('rejectModal').classList.remove('active');
    }
</script>

@endsection
