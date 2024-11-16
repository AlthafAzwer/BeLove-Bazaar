@extends('layouts.admin')

@section('content')
    <style>
        h1 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: #ecf0f1;
            text-transform: uppercase;
        }

        tr:hover {
            background: #f9f9f9;
        }

        td {
            color: #2c3e50;
        }

        /* Buttons */
        button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 4px;
        }

        button[type="submit"] {
            color: #e74c3c;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            color: #c0392b;
        }

        /* Success message */
        .success-message {
            color: #27ae60;
            font-size: 1rem;
            margin-bottom: 20px;
        }
    </style>

    <h1>Manage Users</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
