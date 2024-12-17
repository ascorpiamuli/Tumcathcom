<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | St. Francis of Assisi TUM Catholic Community</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Container */
        .container {
            display: flex;
            height: 100vh;
        }

        /* Left Sidebar */
        .sidebar-left {
            width: 350px; 
            background-color: #6a1b9a; /* Purple color */
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            box-shadow: 3px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0px 10px 10px 0px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .details .community-name {
            font-family: 'Crimson Pro', serif;
            font-size: 2.2rem;
            font-weight: normal;
            margin-bottom: 5px;
            text-align: center;
            color: #ffffff;
        }

        .details .slogan {
            font-size: 1.2rem;
            font-style: italic;
            text-align: center;
            color: #ffffff;
        }

        .details .community-name,
        .details .slogan {
            margin-bottom: 5px;
        }

        /* Right Content Section */
        .content {
            flex-grow: 1;
            background-color: #ffffff;
            padding: 40px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot-password-form {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-form h2 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #6a1b9a; /* Purple color */
            text-align: center;
        }

        .forgot-password-form label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .forgot-password-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .forgot-password-form button {
            width: 100%;
            padding: 14px;
            background-color: #6a1b9a; /* Purple color */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .forgot-password-form button:hover {
            background-color: #4b1480; /* Darker purple */
        }

        .forgot-password-form .back-to-login {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .forgot-password-form .back-to-login a {
            color: #6a1b9a; /* Purple color */
            text-decoration: none;
            font-weight: bold;
        }

        .forgot-password-form .back-to-login a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background-color: #6a1b9a; /* Purple color */
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        .footer img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<?= view('partials/messages') ?>
<div class="container">
    <!-- Left Sidebar -->
    <div class="sidebar-left">
        <div class="logo-container">
        <img src="<?= base_url('/assets/images/cathcomlogo.jpg') ?>" alt="St. Francis of Assisi TUM Catholic Community Logo" class="logo">
        </div>
        <div class="details">
            <div class="community-name">St. Francis of Assisi</div>
            <div class="community-name" style="font-weight: bold;">TUM Catholic Community</div>
            <div class="slogan">Grow in Christ</div>

        </div>
    </div>
    <!-- End Left Sidebar -->

    <!-- Right Content Section -->
    <div class="content">
        <div class="forgot-password-form">
            <h2>Forgot Password</h2>
            <form action="https://example.com/forgot-password" method="POST">
                <div class="form-group">
                    <label for="email">Enter Your Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                </div>
                <button type="submit">Send Reset Link</button>
                <div class="back-to-login">
                    <p>Remembered your password? <a href="login.html">Back to Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <!-- End Right Content Section -->
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 St. Francis of Assisi TUM Catholic Community. All Rights Reserved.</p>
</div>
<!-- End Footer -->

</body>
</html>
