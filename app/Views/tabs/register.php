<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Set Up Your Profile to Continue</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profile Setup</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title"> Shalom,Complete Registration to Get to the System</div></div>
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                    <!--begin::Form-->
                    <form class="needs-validation" action="<?= site_url('/tabs/register') ?>" enctype="multipart/form-data" method="POST" novalidate>
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">First Name</label>
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" id="validationCustom01" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last Name</label>
                            <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" id="validationCustom02" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Year of Study</label>
                            <input type="number" name="year_of_study" placeholder="Enter Year of Study" class="form-control" id="validationCustom04" />
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom06" class="form-label">Registration Number</label>
                            <div class="input-group has-validation">
                            <input type="text" class="form-control" id="validationCustom06" aria-describedby="inputGroupPrepend" name="registration_number" placeholder="Enter Registration Number" />
                            <div class="invalid-feedback">Invalid Input. This Field cannot be Empty.</div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom07" class="form-label">Date of Birth</label>
                            <div class="input-group has-validation">
                            <input type="date" class="form-control" id="validationCustom07" aria-describedby="inputGroupPrepend" name="dob" placeholder="Select Date of Birth" />
                            <div class="invalid-feedback">Invalid Input. This Field cannot be Empty.</div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom08" class="form-label">School/Institute</label>
                            <select name="course" class="form-control" id="validationCustom08">
                                <option value="" selected disabled>Select School/Institute</option>
                                <option value="School of Engineering">School of Engineering</option>
                                <option value="School of Business">School of Business</option>
                                <option value="School of Computing">School of Computing</option>
                                <option value="School of Medicine">School of Medicine</option>
                                <option value="School of Law">School of Law</option>
                                <option value="School of Education">School of Education</option>
                            </select>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                        <!--end::Col-->


                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom09" class="form-label">Baptized</label>
                            <select class="form-control" name="baptized" id="validationCustom09">
                                <option value="" selected disabled>Select Baptism Status</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom10" class="form-label">Confirmed</label>
                            <select class="form-control" name="confirmed" id="validationCustom10">
                                <option value="" selected disabled>Select Confirmation Status</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                        <!--end::Col-->


                        <div class="col-md-6">
                            <label for="familySearch" class="form-label">Family/Jumuia</label>
                            <input type="text" id="familySearch" name="family" class="form-control" autocomplete="off" list="familyList" placeholder="Enter Family/Jumuia" />
                            <datalist id="familyList">
                                <!-- Dynamically populated with search results -->
                            </datalist>
                        </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex justify-content-between">
                        <!-- Update Profile Button on the Far Left -->
                        <button class="btn btn-primary" id="buttonSubmit" type="submit">Submit Registration Details</button>
                    </div>
                    <!--end::Footer-->
                    </form>
                    <!--end::Form-->

                  <!--begin::JavaScript-->
                  <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (() => {
                      'use strict';

                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      const forms = document.querySelectorAll('.needs-validation');

                      // Loop over them and prevent submission
                      Array.from(forms).forEach((form) => {
                        form.addEventListener(
                          'submit',
                          (event) => {
                            if (!form.checkValidity()) {
                              event.preventDefault();
                              event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                          },
                          false,
                        );
                      });
                    })();
                  </script>
                  <!--end::JavaScript-->
                </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
<?= $this->endSection() ?>
<?=$this->section('scripts')?>

<script>
    // Toggle visibility for the password field
document.getElementById('togglePassword').addEventListener('click', function () {
  const passwordInput = document.getElementById('validationCustomPassword');
  const icon = this.querySelector('i');

  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.remove('bi-eye-slash');
    icon.classList.add('bi-eye');
  } else {
    passwordInput.type = 'password';
    icon.classList.remove('bi-eye');
    icon.classList.add('bi-eye-slash');
  }
});

// Toggle visibility for the confirm password field
document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
  const confirmPasswordInput = document.getElementById('validationCustomConfirmPassword');
  const icon = this.querySelector('i');

  if (confirmPasswordInput.type === 'password') {
    confirmPasswordInput.type = 'text';
    icon.classList.remove('bi-eye-slash');
    icon.classList.add('bi-eye');
  } else {
    confirmPasswordInput.type = 'password';
    icon.classList.remove('bi-eye');
    icon.classList.add('bi-eye-slash');
  }
});

</script>
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
<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Select all sidebar and navbar links
      const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
      const navbarLinks = document.querySelectorAll('.navbar');

      // Function to disable links
      function disableLinks(links) {
          links.forEach(link => {
              link.style.pointerEvents = 'none'; // Disable clicking
              link.style.opacity = '0.3'; // Make it look disabled
              link.style.cursor = 'not-allowed'; // Show not-allowed cursor
          });
      }

      // Disable sidebar and navbar links
      disableLinks(sidebarLinks);
      disableLinks(navbarLinks);

      // Enable links after form submission
      const form = document.querySelector('.needs-validation');
      if (form) {
          form.addEventListener('submit', function () {
              sidebarLinks.forEach(link => {
                  link.style.pointerEvents = 'auto'; // Enable clicking
                  link.style.opacity = '1'; // Restore normal appearance
                  link.style.cursor = 'pointer'; // Restore cursor
              });

              navbarLinks.forEach(link => {
                  link.style.pointerEvents = 'auto';
                  link.style.opacity = '1';
                  link.style.cursor = 'pointer';
              });
          });
      }
  });
</script>




<?=$this->endSection()?>