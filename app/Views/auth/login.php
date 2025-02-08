<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #f4f4f4, #e0d4f7);
            animation: fadeIn 1s ease-in-out;
        }
        html, body {
            height: 100%;
            overflow-y: auto;
        }
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: max-width 0.3s ease-in-out;
        }
        .form-login {
            max-width: 400px;
        }
        .form-register {
            max-width: 550px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: slideUp 1s ease-in-out;
            width: 100%;
        }
        .form-label {
            text-align: left;
            display: block;
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            transition: 0.3s;
        }
        .form-control:focus {
            box-shadow: 0px 0px 8px #6a1b9a;
        }
        .btn-custom {
            background-color: #6a1b9a;
            color: #fff;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #53147a;
            transform: scale(1.05);
        }
        .toggle-form {
            cursor: pointer;
            color: #6a1b9a;
            transition: 0.3s;
        }
        .toggle-form:hover {
            text-decoration: underline;
        }
        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 10px auto;
            animation: bounce 2s infinite;
        }
        .cross-icon {
            font-size: 32px;
            color: #6a1b9a;
            margin-bottom: 10px;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <div class="container">
    <?= view('partials/messages') ?>
        <div class="card p-4 form-container form-login" id="form-container">
            <div class="cross-icon"><i class="fas fa-cross"></i></div>
            <img src="<?= base_url('/assets/images/cathcomlogo.jpg') ?>" alt="Logo" class="logo">
            <h3 class="text-center mb-4" id="form-title">Member Login</h3>
            <form id="auth-form" action="<?=site_url('auth/login')?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
            <p class="text-center mt-3">
                <span class="toggle-form">Don't have an account? Sign up</span></br>
                <strong><a href="<?=site_url('auth/admin/login')?>">Administrator Login</a><strong>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.toggle-form').addEventListener('click', function () {
                let formContainer = document.getElementById('form-container');
                let form = document.getElementById('auth-form');
                let title = document.getElementById('form-title');
                let isLogin = form.getAttribute('action').includes('login');

                // Get Base URL Dynamically
                let baseUrl = "<?=site_url()?>";

                // Toggle action and title
                form.setAttribute("action", isLogin ? baseUrl + "/auth/authentication" : baseUrl + "auth/login");
                form.setAttribute("method", "POST"); // Ensure POST method is set
                title.innerText = isLogin ? "Member Registration" : "Member Login";

                formContainer.classList.toggle('form-login', !isLogin);
                formContainer.classList.toggle('form-register', isLogin);

                // Form content
                let formContent = isLogin ? `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="row g-3">
                    <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text">+254</span>
                                <input type="number" class="form-control" name="phone" placeholder="7XXXXXXXX" pattern="[7-9][0-9]{8}" maxlength="9" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Residence</label>
                            <input type="text" class="form-control" name="residence" placeholder="Area of Residence">
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control password-field" name="password" placeholder="Enter Password" required>
                                <span class="input-group-text toggle-password">&#128065;</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control password-field" name="confirm_password" placeholder="Confirm Password" required>
                                <span class="input-group-text toggle-password">&#128065;</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mt-3">Sign Up</button>
                ` : `
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control password-field" name="password" placeholder="Enter Password" required>
                            <span class="input-group-text toggle-password">&#128065;</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Login</button>
                `;

                form.innerHTML = formContent;
                attachPasswordToggle();
            });

            // Function to add password toggle functionality
            function attachPasswordToggle() {
                document.querySelectorAll(".toggle-password").forEach(toggle => {
                    toggle.addEventListener("click", function () {
                        let passwordInput = this.previousElementSibling;
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            this.innerHTML = "&#128064;"; // Open eye icon
                        } else {
                            passwordInput.type = "password";
                            this.innerHTML = "&#128065;"; // Closed eye icon
                        }
                    });
                });
            }

            // Attach password toggle on initial load
            attachPasswordToggle();
        });
    </script>
</body>
</html>