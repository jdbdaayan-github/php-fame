<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fame Framework</title>
<style>
    /* Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Header */
    header {
        width: 100%;
        padding: 20px 40px;
        background-color: #ffffff; /* light navbar */
        color: #0b1d3a;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
    }
    header h1 {
        font-size: 28px;
    }
    header nav a {
        color: #0b1d3a; /* dark text for links */
        text-decoration: none;
        margin-left: 20px;
        font-weight: bold;
    }
    header nav a:hover {
        text-decoration: underline;
    }

    /* Main Container */
    .container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .welcome-box {
        max-width: 800px;
        text-align: center;
        background-color: #ffffff;
        padding: 50px 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .welcome-box h2 {
        font-size: 48px;
        color: #0b1d3a;
        margin-bottom: 20px;
    }
    .welcome-box p {
        font-size: 18px;
        margin-bottom: 30px;
        color: #555;
    }
    .btn-primary {
        background-color: darkblue;
        color: #ffffff;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-primary:hover {
        background-color: #0b1d3a;
    }

    /* Features Section */
    .features {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
    }
    .feature {
        flex: 1 1 200px;
        background-color: #f1f3f5;
        padding: 20px;
        border-radius: 6px;
        text-align: center;
    }
    .feature h3 {
        color: #0b1d3a;
        margin-bottom: 10px;
    }
    .feature p {
        font-size: 14px;
        color: #555;
    }

    /* Footer */
    footer {
        text-align: center;
        padding: 20px;
        font-size: 12px;
        background-color: #ffffff; /* light footer */
        color: #0b1d3a;
        border-top: 1px solid #ddd;
    }

</style>
</head>
<body>

<header>
    <h1>Fame</h1>
    <nav>
        <a href="{{ url('/')}}">Docs</a>
        <a href="{{ url('/about')}}">GitHub</a>
        <a href="#">Learn</a>
        <a href="#" class="btn-primary">Download</a>
    </nav>
</header>

<div class="container">
    <div class="welcome-box">
        <h2>Welcome to Fame Framework</h2>
        <p>The small and powerful PHP framework for developers who want simplicity, speed, and elegance. Get started quickly and build your web applications with ease.</p>
        <a href="#" class="btn-primary">Get Started</a>

        <div class="features">
            <div class="feature">
                <h3>Lightweight & Fast</h3>
                <p>Minimal footprint, maximum performance for modern apps.</p>
            </div>
            <div class="feature">
                <h3>Secure</h3>
                <p>Built-in protection against CSRF, XSS, and other threats.</p>
            </div>
            <div class="feature">
                <h3>Easy to Learn</h3>
                <p>Simple syntax and clear structure speed up development.</p>
            </div>
            <div class="feature">
                <h3>Modular</h3>
                <p>Organize your app with modules and reusable components.</p>
            </div>
        </div>
    </div>
</div>

<footer>
    &copy; 2025 Fame Framework
</footer>

</body>
</html>
