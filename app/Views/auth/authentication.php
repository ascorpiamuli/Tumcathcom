<?= view('partials/messages') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Your Login Details | St. Francis of Assisi TUM Catholic Community</title>
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
            height: 100vh;
            display: flex;
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
            position: fixed; /* Make sidebar fixed */
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1; /* Ensure sidebar is above other content */
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

        .details .community-name {
            font-weight: bold;
        }

        /* Right Content Section */
        .content {
            margin-left: 350px; /* Push the content to the right of the sidebar */
            padding: 40px 30px;
            flex-grow: 1;
            background-color: #ffffff;
            overflow-y: auto; /* Make this section scrollable */
        }

        .login-form {
            width: 100%;
            max-width: 700px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #6a1b9a; /* Purple color */
            text-align: center;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            width: 30%;
        }

        .form-group input {
            width: 65%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Button */
        .login-form button {
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

        .login-form button:hover {
            background-color: #4b1480; /* Darker purple */
        }

        /* Back to login link */
        .back-to-login {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #6a1b9a; /* Purple color */
            text-decoration: none;
            font-weight: bold;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

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

    <div class="login-form">
        <h2>Set Your Login Details</h2>
        <form action="<?= site_url('auth/authentication') ?>" method="POST" id="loginForm">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (+254)</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="^(\+254\d{9})$" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>

            <button type="submit">Submit</button>
        </form>

        <div class="back-to-login">
            <p>Already have an account? <a href="<?php echo site_url('auth/login'); ?>">Login</a></p>
        </div>
    </div>
</div>
<!-- End Right Content Section -->

<script>
    // Client-side password match validation
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            e.preventDefault(); // Prevent form submission
            alert('Passwords do not match!');
        }
    });
</script>

</body>
</html>
