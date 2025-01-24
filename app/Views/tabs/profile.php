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
              <div class="col-sm-6"><h3 class="mb-0">My Profile</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">My Profile</li>
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
                  <div class="card-header"><div class="card-title">Update Profile</div></div>
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form class="needs-validation" action="<?= site_url('/tabs/profile') ?>" enctype="multipart/form-data" method="POST" novalidate >
                    <!--begin::Body-->
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">First Name</label>
                          <input
                            type="text"
                            name="fname"
                            class="form-control"
                            id="validationCustom01"
                           value="<?= isset($userprofile['first_name']) ? $userprofile['first_name'] : '' ?>"
                        
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Last Name</label>
                          <input
                            type="text"
                            name="lname"
                            class="form-control"
                            id="validationCustom01"
                             value="<?= isset($userprofile['last_name']) ? $userprofile['last_name'] : '' ?>"
                        
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Update Your Email</label>
                          <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="validationCustom01"
                            value="<?=$userauthprofile['email']?>"
                            
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Year of Study</label>
                          <input
                            type="number"
                            name="yearofstudy"
                            class="form-control"
                            id="validationCustom01"
                            value="<?=$userprofile['year_of_study']?>"
                            
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Update Phone</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">+254</span>
                            <input
                              type="number"
                              value="<?=$userauthprofile['phone_number']?>"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              placeholder="eg.795751700"
                              name="phone"

                            />
                            <div class="invalid-feedback">Update Phone Number.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Update Registration Number</label>
                          <div class="input-group has-validation">
                            <input
                              type="text"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              name="registration_number"
                              value="<?=$userprofile['registration_number']?>"
                            
                            />
                            <div class="invalid-feedback">Invalid Input.This Field cannot be Empty.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Date of Birth</label>
                          <div class="input-group has-validation">
                            <input
                              type="date"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              name="dob"
                              value="<?=$userprofile['dob']?>"
                              
                            />
                            <div class="invalid-feedback">Invalid Input.This Field cannot be Empty.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="profileImage" class="form-label">Upload Profile Image</label>
                            <div class="input-group has-validation">
                                <input
                                type="file"
                                class="form-control"
                                id="profileImage"
                                name="profile_image"
                                accept="image/*"
                                />
                                <div class="invalid-feedback">Please upload a valid image file.</div>
                            </div>
                            </div>

                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Family/Jumuia</label>
                          <select class="form-select" name="family" id="validationCustom04" required>
                            <option value="<?=$family?>" selected><?=$family?></option>
                        </select>
                          <div class="invalid-feedback">Please select a valid Jumuia.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                        <label for="validationCustomPassword" class="form-label">Update Password</label>
                        <div class="input-group has-validation">
                            <input
                            type="password"
                            class="form-control"
                            id="validationCustomPassword"
                            name="password"
                            placeholder="Enter new password (leave blank to keep current password)"
                            />
                            <button
                            type="button"
                            class="btn btn-outline-secondary"
                            id="togglePassword"
                            tabindex="-1"
                            >
                            <i class="bi bi-eye-slash"></i>
                            </button>
                            <div class="invalid-feedback">Please provide a valid password.</div>
                        </div>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6">
                        <label for="validationCustomConfirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group has-validation">
                            <input
                            type="password"
                            class="form-control"
                            id="validationCustomConfirmPassword"
                            name="confirm_password"
                            placeholder="Confirm new password (leave blank to keep current password)"

                            />
                            <button
                            type="button"
                            class="btn btn-outline-secondary"
                            id="toggleConfirmPassword"
                            tabindex="-1"
                            >
                            <i class="bi bi-eye-slash"></i>
                            </button>
                            <div class="invalid-feedback">Passwords must match.</div>
                        </div>
                        </div>
                       <!--end::Col-->

                      </div>
                      <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex justify-content-between">
                    <!-- Update Profile Button on the Far Left -->
                    <button class="btn btn-primary" id="buttonSubmit" type="submit">Update Profile</button>

                    <!-- Delete Profile Button with AJAX -->
                    <button class="btn btn-danger" id="buttonDelete" type="button" onclick="deleteProfile()">
                        Delete Profile
                    </button>
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
  // Utility function to create and display status message
  function createStatusMessage(status, targetContainerId, submitButtonId) {
    if (!status) return; // Exit if status is undefined or null

    const statusLower = status.toLowerCase();
    const targetContainer = document.getElementById(targetContainerId);
    if (!targetContainer) {
      console.error(`Target container with ID '${targetContainerId}' not found.`);
      return;
    }

    // Create the status message div
    const statusDiv = document.createElement('div');
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    const icon = document.createElement('span');
    icon.style.marginRight = '10px';

    const message = document.createElement('span');

    // Configure styles and messages based on status
    switch (statusLower) {
      case 'pending':
        statusDiv.style.backgroundColor = '#ffcc80'; // Orange
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#d35400';
        icon.innerHTML = '&#128712;'; // Hourglass icon ⌛
        message.innerHTML = `
          <strong>Pending Confirmation:</strong> Your registration is under confirmation. 
          Please wait for approval, which will take less than 48 hours. Approval is done by Family Head.
        `;
        break;

      case 'approved':
        statusDiv.style.backgroundColor = '#d4edda'; // Green
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#155724';
        icon.innerHTML = '&#9989;'; // Checkmark ✅
        message.innerHTML = `
          <strong>Approved:</strong> Your registration has been approved. Please wait for the Class Schedule from the Liturgy Committee.
        `;
        break;

      case 'declined':
        statusDiv.style.backgroundColor = '#f8d7da'; // Red
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#721c24';
        icon.innerHTML = '&#10060;'; // Cross ❌
        message.innerHTML = `
          <strong>Declined:</strong> Your registration has been declined. Please contact the Liturgical Office.
        `;
        break;

      default:
        console.error(`Unknown status: ${status}`);
        return;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the status div to the target container
    targetContainer.appendChild(statusDiv);

    // Disable the form submission button if necessary
    if (statusLower === 'pending' || statusLower === 'approved') {
      const submitButton = document.getElementById(submitButtonId);
      if (submitButton) {
        submitButton.disabled = true;
      } else {
        console.error(`Submit button with ID '${submitButtonId}' not found.`);
      }
    }
  }

  // Status values from server-side PHP
  const status = "<?php echo isset($registrationdata['status']) ? $registrationdata['status'] : 'null'; ?>";

  // Call the function for each status
  createStatusMessage(status, 'regitrationContainer', 'buttonSubmit');

</script>
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
  function deleteProfile() {
    if (confirm('Are you sure you want to delete your profile?')) {
      fetch('<?= site_url("/tabs/deleteProfile") ?>', {
        method: 'POST',
        body: new FormData(), // send an empty form data if needed
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Profile deleted successfully!');
          // Optionally, redirect or update UI
        } else {
          alert('Error deleting profile');
        }
      })
      .catch(error => console.error('Error:', error));
    }
  }
</script>

<?=$this->endSection()?>