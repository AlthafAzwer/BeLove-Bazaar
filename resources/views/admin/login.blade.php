<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #3498db, #2ecc71);
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
            display: inline-block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #2980b9;
        }

        .error {
            background: #e74c3c;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .login-container form {
            margin-top: 10px;
        }

        /* Responsive Styling */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
            }

            h2 {
                font-size: 1.5rem;
            }

            input[type="email"],
            input[type="password"],
            .btn-login {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>
