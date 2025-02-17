<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | St. Francis of Assisi TUM Catholic Community</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/assets/css/register.css') ?>">
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
        <div class="register-form">
            <h2>Create an Account</h2>
            <form id="registerForm" action="<?= site_url('auth/register') ?>" method="POST">
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
                        <option value="6">6th Year</option>
                        <option value="Post-Graduate">Post-Graduate</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="familySearch">Family/Jumuia</label>
                    <input type="text" id="familySearch" name="family" class="form-control" placeholder="Search your Family/Jumuia" autocomplete="off" list="familyList"/>
                    <datalist id="familyList">
                        <!-- Dynamically populated with search results -->
                    </datalist>
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
                    <label for="course">School/Institute</label>
                    <select id="course" name="course" required>
                        <option value="" disabled selected>Select your School/Institute</option>
                        <option value="School of Engineering and Technology">School of Engineering and Technology</option>
                        <option value="School of Business">School of Business</option>
                        <option value="Institute of Computing and Informatics">Institute of Computing and Informatics</option>
                        <option value="School of Health and Health Sciences">School of Health and Health Sciences</option>
                        <option value="School of Social Sciences">School of Social Sciences</option>
                        <!-- Add all courses TUM schools here -->
                    </select>
                </div>

                <button type="submit">Register</button>
            </form>

            <div class="back-to-login">
                <p>Already have an account? <a href="<?=site_url('auth/login')?>">Login</a></p>
            </div>
        </div>
    </div>
    <!-- End Right Content Section -->

    <script>
    // Wait until the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        const familySearchInput = document.getElementById('familySearch');
        const familyList = document.getElementById('familyList');
        const registerForm = document.getElementById('registerForm');

        // Store the valid family names for validation
        let validFamilies = [];

        // Attach event listener to the familySearch input field
        familySearchInput.addEventListener('input', function () {
            const query = this.value.trim(); // Get the input value and trim whitespace

            // Reset datalist options
            familyList.innerHTML = '';

            if (query.length > 0) {
                console.log('User is typing:', query); // Log the value in real-time

                // Show a loading option in the datalist
                const loadingOption = document.createElement('option');
                loadingOption.value = 'Loading...';
                familyList.appendChild(loadingOption);

                // Make the API request to get the family names
                fetch(`/tumcathcom/public/index.php/getJumuia?query=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        familyList.innerHTML = ''; // Clear loading option

                        if (data.length === 0) {
                            const noResultOption = document.createElement('option');
                            noResultOption.value = '';
                            noResultOption.textContent = 'No matching results';
                            familyList.appendChild(noResultOption);
                        } else {
                            validFamilies = data.map(item => item.title); // Assuming 'title' is the family name
                            // Populate datalist with results from the API
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.title; // Assuming 'title' is the family name
                                familyList.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching Jumuia:', error);
                        const errorOption = document.createElement('option');
                        errorOption.value = '';
                        errorOption.textContent = 'Error fetching data';
                        familyList.appendChild(errorOption);
                    });
            }
        });

        // Prevent form submission if the selected family is not in the valid list
        registerForm.addEventListener('submit', function (e) {
            const familyValue = familySearchInput.value.trim();
            if (familyValue && !validFamilies.includes(familyValue)) {
                e.preventDefault();
                alert('Please select a valid family name from the dropdown');
            }
        });
    });
    </script>
</body>
</html>
