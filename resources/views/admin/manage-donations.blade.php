@extends('layouts.admin')

@section('content')
<div style="margin-top: 40px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
    <h1 style="font-size: 24px; color: #333;">Manage Donations</h1>

    @if(session('success'))
        <div style="margin-top: 10px; padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto; margin-top: 20px;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px; background-color: #fff; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f5f5f5; text-align: left;">
                    <th style="padding: 12px; border-bottom: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px; border-bottom: 1px solid #ddd;">Name</th>
                    <th style="padding: 12px; border-bottom: 1px solid #ddd;">Certification</th>
                    <th style="padding: 12px; border-bottom: 1px solid #ddd;">Phone</th>
                    <th style="padding: 12px; border-bottom: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $donation)
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $donation->id }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $donation->name }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                            <a href="{{ asset('storage/' . $donation->certification) }}" target="_blank" style="color: #007bff; text-decoration: none;">View</a>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $donation->phone }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                            <form action="{{ route('admin.delete-donation', $donation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #dc3545; color: #fff; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;" onclick="return confirm('Are you sure you want to delete this donation?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
