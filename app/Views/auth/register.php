<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | St. Francis of Assisi TUM Catholic Community</title>
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

        .register-form {
            width: 100%;
            max-width: 700px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .register-form h2 {
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

        .form-group input, .form-group select {
            width: 65%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Button */
        .register-form button {
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

        .register-form button:hover {
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
<?= view('partials/messages') ?>
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
    <div class="register-form">
        <h2>Create an Account</h2>
        <form action="<?= site_url('auth/register') ?>" method="POST">
          <?= csrf_field() ?>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" id="registration_number" name="registration_number" placeholder="Enter your registration number" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label for="year_of_study">Year of Study</label>
                <select id="year_of_study" name="year_of_study" required>
                    <option value="" disabled selected>Select your year of study</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                    <option value="5">5th Year</option>
                </select>
            </div>

            <div class="form-group">
                <label for="family">Family/Jumuia</label>
                <select id="family" name="family" required>
                    <option value="" disabled selected>Select your Family/Jumuia</option>
                    <option value="st_lucy">St. Lucy</option>
                    <option value="st_catherine_of_sienna">St.Catherine of Sienna</option>
                    <option value="st_joseph">St.Joseph the Worker</option>
                    <option value="st_jude_thaddeus">St.Jude Thaddeus</option>
                    <option value="st_agnes_of_rome">St. Agnes of Rome</option>
                    <option value="st_dominic">St.Dominic</option>
                    <option value="st_charles_lwanga">St. Charles Lwanga</option>
                    <option value="st_michael">St. Michael</option>
                </select>
            </div>

            <div class="form-group">
                <label for="baptized">Are You Baptized?</label>
                <select id="baptized" name="baptized" required>
                    <option value="" disabled selected>Select Yes or No</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="confirmed">Are You Confirmed?</label>
                <select id="confirmed" name="confirmed" required>
                    <option value="" disabled selected>Select Yes or No</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="course">Course</label>
                <select id="course" name="course" required>
                    <option value="" disabled selected>Select your course</option>
                    <option value="computer_science">Computer Science</option>
                    <option value="information_technology">Information Technology</option>
                    <option value="electrical_engineering">Electrical Engineering</option>
                    <option value="civil_engineering">Civil Engineering</option>
                    <option value="architecture">Architecture</option>
                    <!-- Add all courses TUM offers here -->
                </select>
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="back-to-login">
            <p>Already have an account? <a href="login.html">Login</a></p>
        </div>
    </div>
</div>
<!-- End Right Content Section -->

</body>
</html>
