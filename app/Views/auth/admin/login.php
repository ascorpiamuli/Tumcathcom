<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login & Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #f4f4f4, #e0d4f7);
            animation: fadeIn 1s ease-in-out;
        }
        html, body {
            height: 100%;
            overflow-y: auto; /* Enables scrolling */
        }
        .container {
            max-width: 400px;
            min-height: 100vh; /* Ensures the container can expand */
            display: flex;
            align-items: center;
            justify-content: center;
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
            display: block; /* Ensures label stays in place */
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px; /* Reduced border radius */
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
        <div class="card p-4">
            <div class="cross-icon"><i class="fas fa-cross"></i></div>
            <img src="<?= base_url('/assets/images/cathcomlogo.jpg') ?>" alt="Logo" class="logo">
            <h3 class="text-center mb-4" id="form-title">Admin Login</br>(Main Office & Council)</h3>
            <form id="auth-form" action="<?=site_url('auth/admin/login')?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Departmental Reg Number</label>
                    <input type="text" class="form-control" name="deptcode" placeholder="Enter Reg Number" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
            <p class="text-center mt-3">
                <span class="toggle-form">Don't have an Admin account? Sign up</span></br>
                <strong><a href="<?=site_url('auth/login')?>">Member Login</a><strong>
            </p>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('.toggle-form').addEventListener('click', function () {
        let form = document.getElementById('auth-form');
        let title = document.getElementById('form-title');
        let isLogin = form.getAttribute('action').includes('login');

        // Get Base URL Dynamically
        let baseUrl = "<?= site_url() ?>";
        console.log(baseUrl);
        form.setAttribute("method", "POST"); // Ensure POST method
        // Toggle form action and title
        form.setAttribute("action", isLogin ? baseUrl + "/auth/admin/register" : baseUrl + "/auth/admin/login");

        title.innerText = isLogin ? "Admin Registration" : "Admin Login";

        // Update form content dynamically
        form.innerHTML = isLogin ? `
            <div class="mb-3">
                <label class="form-label">Select Position</label>
                <select class="form-control" name="position" required>
                    <option value="" disabled selected>Select a position</option>
                    <option value="Chairperson">Chairperson (Chief Admin)</option>
                    <option value="Vice Chairperson">Vice Chairperson</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Vice Secretary">Vice Secretary</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Small Christian Community Coordinator">Small Christian Community Coordinator</option>
                    <option value="Liturgical Coordinator">Liturgical Coordinator</option>
                    <option value="Organizing Secretary">Organizing Secretary</option>
                    <option value="Assets Manager">Assets Manager</option>
                    <option value="Hospitality Manager">Hospitality Manager</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Your Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email (Member account email)" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control password-field" name="password" placeholder="Create a Password" required>
                    <span class="input-group-text toggle-password">&#128065;</span>
                </div>
            </div>
            <button type="submit" class="btn btn-custom w-100">Sign Up</button>
        ` : `
            <div class="mb-3">
                <label class="form-label">Departmental Reg Number</label>
                <input type="text" class="form-control" name="deptcode" placeholder="Enter Reg Number" required>
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

        // Update button text
        this.innerText = isLogin ? "Already have an Admin account? Login" : "Don't have an account? Sign up";

        // Attach password toggle functionality
        attachPasswordToggle();
    });

    // Function to add password visibility toggle
    function attachPasswordToggle() {
        document.querySelectorAll(".toggle-password").forEach(toggle => {
            toggle.addEventListener("click", function () {
                let passwordInput = this.previousElementSibling;
                passwordInput.type = passwordInput.type === "password" ? "text" : "password";
                this.innerHTML = passwordInput.type === "password" ? "&#128065;" : "&#128064;"; // Eye icon toggle
            });
        });
    }

    // Attach password toggle on initial load
    attachPasswordToggle();
});
</script>

</body>
</html>
