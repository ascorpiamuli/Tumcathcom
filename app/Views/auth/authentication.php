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

       /* Form Alignment */
.login-form {
    width: 100%;
    max-width: 790px;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin: 0 auto; /* Center the form horizontally */
    text-align: center; /* Center text and content */

}

/* Form Group Styling */
.form-group {
    display: flex;
    flex-direction: column; /* Stack label and input */
    align-items: center; /* Center align content within the form group */
    margin-bottom: 20px;
    width: 100%; /* Ensures proper alignment inside the form */
}

/* Label Styling */
.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    text-align: start; /* Center-align label text */
    width: 100%;
    margin-left:220px;
}

/* Input Styling */
.form-group input,
.password-wrapper,
.phone-input-wrapper {
    width: 100%; /* Full width within the form group */
    max-width: 400px; /* Limit maximum width for better alignment */
}

/* Password Wrapper and Phone Input Centered */
.password-wrapper, .phone-input-wrapper {
    display: flex;
    justify-content: center;
}

/* Phone Prefix Styling */
.phone-prefix {
    background-color: #f0f0f0;
    padding: 10px;
    font-size: 16px;
    color: #333;
    border-right: 1px solid #ddd;
}

/* Password Eye Icon Styling */
.password-wrapper .toggle-password {
    right: 10px;
    position: absolute;
    font-size: 22px;
    color: #888;
    cursor:pointer;

}


.password-wrapper .toggle-password:hover {
    color: #333;
    cursor:pointer;
}


        /* Styling for the phone input wrapper */
        .phone-input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            width: 80%; /* Matches other inputs' width */
            overflow: hidden;
        }

        /* Prefix styling */
        .phone-prefix {
            background-color: #f0f0f0;
            padding: 10px;
            border-right: 1px solid #ddd;
            font-size: 16px;
            color: #333;
        }

        /* Phone input field styling */
        .phone-input-wrapper input {
            flex-grow: 1;
            border: none;
            outline: none;
            padding: 12px;
            font-size: 16px;
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
        .login-form h2{
            color: #6a1b9a; /* Purple color */
            margin-bottom:20px;
            text-align:center;
        }

        .back-to-login a {
            color: #6a1b9a; /* Purple color */
            text-decoration: none;
            font-weight: bold;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }
/* Adjustments for Medium Screens (Tablets and Small Laptops) */
@media (max-width: 1024px) {
    .sidebar-left {
        width: 250px; /* Shrinks sidebar for medium screens */
        padding: 30px 15px;
    }

    .content {
        margin-left: 250px; /* Matches the reduced sidebar width */
        padding: 20px;
    }

    .login-form {
        max-width: 600px; /* Reduce form width */
        padding: 20px;
    }

    .form-group label {
        font-size: 14px; /* Slightly smaller labels */
        margin-left: 10px; /* Adjust for alignment */
    }

    .form-group input {
        font-size: 14px; /* Match input field text size */
    }

    .details .community-name {
        font-size: 2rem; /* Adjust font size for community name */
    }
}

/* Adjustments for Small Screens (Mobile Devices) */
@media (max-width: 768px) {
    .sidebar-left {
        width: 40%; /* Shrinks sidebar further */
        height: auto;
        position: relative;
        padding: 20px;
        text-align: center;
    }

    .content {
        margin-left: 0; /* Stack the sidebar and content */
        padding: 20px;
    }

    .form-group {
        flex-direction: column;
        align-items: flex-start; /* Align items to the start */
    }

    .form-group label {
        width: 100%;
        text-align: left;
        margin-left: 0; /* Remove fixed margin */
        font-size: 13px; /* Smaller labels */
    }

    .form-group input, 
    .password-wrapper, 
    .phone-input-wrapper {
        width: 100%; /* Full width for inputs */
    }
}

/* Adjustments for Very Small Screens (Extra Small Devices) */
@media (max-width: 480px) {
    .sidebar-left {
        display: none; /* Hide the sidebar */
    }

    .logo {
        width: 100px;
        height: 100px; /* Smaller logo size */
    }

    .details .community-name {
        font-size: 1.8rem; /* Reduce community name size */
    }

    .details .slogan {
        font-size: 0.9rem; /* Shrink slogan font */
    }

    .login-form {
        max-width: 100%; /* Full width for form */
        padding: 15px;
    }

    .form-group label {
        font-size: 12px; /* Compact label font */
        margin-left: 0; /* Align to the left */
    }

    .form-group input {
        font-size: 14px;
        padding: 8px; /* Compact padding */
    }

    .login-form button {
        padding: 12px; /* Smaller button size */
        font-size: 14px;
    }
}

/* General Adjustments for Better Scaling */
@media (max-width: 360px) {
    .sidebar-left {
        display: none; /* Hide the sidebar */
    }

    .content {
        margin-left: 0; /* Remove the sidebar margin */
        padding: 20px; /* Add some padding for better content spacing */
    }
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
                <div class="phone-input-wrapper">
                    <input type="text"  name="username" placeholder="Enter Your username" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="phone-input-wrapper">
                    <input type="email"  name="email" placeholder="Enter Your email address" required>
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <div class="phone-input-wrapper">
                    <span class="phone-prefix">+254</span>
                    <input type="tel" id="phone" name="phone" placeholder="795751700" maxlength="9" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="phone-input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <span class="toggle-password" data-target="password">&#128065;</span> <!-- Eye icon -->
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="phone-input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                    <span class="toggle-password" data-target="confirm_password">&#128065;</span> <!-- Eye icon -->
                </div>
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
    document.addEventListener('DOMContentLoaded', () => {
    const toggleIcons = document.querySelectorAll('.toggle-password');

    toggleIcons.forEach((icon) => {
        icon.addEventListener('click', () => {
            const target = document.getElementById(icon.getAttribute('data-target'));
            const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
            target.setAttribute('type', type);

            // Change the icon (optional)
            icon.textContent = type === 'password' ? '👁️' : '🙈'; // Eye and crossed-eye emoji
        });
    });
});

</script>
</body>
</html>
