<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Relove Bazaar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fullscreen Background Video */
        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Overlay for video */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        /* Log In Section */
        .top-right-login {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .login-text {
            font-size: 1em;
            color: #ffffff;
            opacity: 0.9;
        }
        .login-button {
            padding: 10px 20px;
            background-color: #4a90e2;
            color: white;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }
        .login-button:hover {
            background-color: #357ab9;
        }

        .welcome-container {
            text-align: center;
            padding: 40px;
            border-radius: 12px;
            max-width: 500px;
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            color: #fff;
            animation: fadeIn 2s ease-in-out;
        }

        .logo {
            width: 120px;
            margin-bottom: 20px;
            animation: zoomIn 1.5s ease forwards;
        }

        .title {
            font-size: 2.5em;
            color: #ffffff;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .description {
            font-size: 1.1em;
            color: #e0e0e0;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* Register Button Styling */
        .button-register {
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 1.1em;
            text-decoration: none;
            color: white;
            background-color: #50e3c2;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 10px rgba(80, 227, 194, 0.5);
        }
        .button-register:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 255, 255, 0.3);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Background Video -->
    <video autoplay loop muted playsinline class="background-video">
        <source src="{{ asset('videos/video.mov') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay to darken the video background -->
    <div class="overlay"></div>

    <!-- Top-Right Log In Section with Text -->
    <div class="top-right-login">
        <span class="login-text">Already have an account?</span>
        <a href="{{ route('login') }}" class="login-button">Log In</a>
    </div>

    <!-- Welcome Container -->
    <div class="welcome-container">
        <!-- Logo -->
        <img src="{{ asset('images/Relove logo.png') }}" alt="Website Logo" class="logo">

        <!-- Welcome Message and Description -->
        <h1 class="title">Welcome to <br> Relove Bazaar</h1>
        <p class="description">Explore a world of pre-loved treasures and find something unique just for you. Whether you're buying, selling, or donating, we're here to connect you with the community!</p>

        <!-- Centered Register Button -->
        <a href="{{ route('register') }}" class="button-register">Register</a>
    </div>

</body>
</html>
