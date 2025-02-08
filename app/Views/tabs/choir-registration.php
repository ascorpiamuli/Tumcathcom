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
              <div class="col-sm-6"><h3 class="mb-0">Choir Registration</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Choir Registration</li>
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
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-14">
              <div class="card card-primary bg-info card-outline mb-4">
                <div class="card-header">
                  <h2 class="card-title typingEffect">Choir Registration Information</h2>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <ul>
                    <li>All choir members must be officially registered for the semester before applying for choir registration.</li>
                    <li>New members should attend at least two practice sessions before registering.</li>
                    <li>Registration must be completed within the first two weeks of the term (registration dates will be communicated by the Choir Coordinator).</li>
                    <li>Members must ensure that all personal and contact information is updated during registration.</li>
                    <li>Once the form is submitted, the Choir Master or Choir Patron will approve the registration request.</li>
                    <li>Members who have not registered will have limited or no access to choir resources, uniforms, or participation in official performances.</li>
                    <li>Choir registration is conducted only once per term for all members, whether active or inactive.</li>
                    <li>All registration records will be maintained by the Choir Secretary and the Chairperson of the Choir.</li>
                    <li>All financial matters will be handled by the Choir Treasurer.</li>
                </ul>
                </div>

                <!-- ./card-body -->
              </div>
              <!-- /.card -->

              <!-- /.col -->
            </div>
            <!--end::Row-->
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Registration Form</div></div>
                  <div id="regitrationContainer"></div>
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form class="needs-validation" action="<?= site_url('/tabs/choir-registration') ?>" method="POST" novalidate >
                    <!--begin::Body-->
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Your Name</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="validationCustom01"
                            value="<?=$fullName?>"
                            readonly
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Progresion Status</label>
                          <select class="form-select" id="validationCustom04" name="progression" required>
                              <option value="" disabled selected>Choose a Progression State...</option>
                              <option value="First Year Student">First Year Student</option>
                              <option value="Continuing Student">Continuing Student</option>
                              <option value="Finalist">Finalist</option>
                              <option value="Post-Graduate Student">Post-Graduate Student</option>
                          </select>
                          <div class="invalid-feedback">Please choose your progression status.</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Your Vocal Part</label>
                          <select class="form-select" id="validationCustom04" name="progression" required>
                              <option value="" disabled selected>Choose your Vocal...</option>
                              <option value="First Year Student">Soprano (S) – Highest female voice</option>
                              <option value="Continuing Student">Alto (A) – Lower female voice</option>
                              <option value="Finalist">Tenor (T) – Higher male voice</option>
                              <option value="Post-Graduate Student">Bass (B) – Lowest male voice</option>
                          </select>
                          <div class="invalid-feedback">Please choose your Vocal Part.</div>
                        </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Payment Amount(Min.50)</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">Shs</span>
                            <input
                              type="number"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              name="amount"
                              value=50
                              required
                            />
                            <div class="invalid-feedback">Invalid Input.This Field cannot be Empty.</div>
                          </div>
                        </div>
                        <!--end::Col-->
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
                        <label for="validationCustom04" class="form-label">Semester Period</label>
                        <select class="form-select" id="validationCustom04" name="semesterperiod" required>
                            <option value="" disabled selected>Choose a Semester...</option>
                            <option value="January-April Semester">January-April Semester</option>
                            <option value="May-August Semester">May-August Semester</option>
                            <option value="September-December Semester">September-December Semester</option>
                        </select>
                        <div class="invalid-feedback">Please select the semester period.</div>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-12">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              value=""
                              id="invalidCheck"
                              required
                            />
                            <label class="form-check-label" for="invalidCheck">
                              I have agreed to Register for this Semester as per the TUMCATHCOM Constitution
                            </label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                      </div>
                      <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button class="btn btn-primary" id="buttonSubmit" type="submit">Register for Semester</button>
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

<?=$this->endSection()?>