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
              <div class="col-sm-6"><h3 class="mb-0">Semester Registration</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Semester Registration</li>
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
                  <h2 class="card-title typingEffect">Semester Registration Information</h2>
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
                  <li>All students must clear their previous semester dues before registering for the new semester.</li>
                  <li>First-year students should not register for their first semester.</li>
                  <li>Registration must be completed within the first two weeks of the semester (registration dates will be communicated by the SCC Coordinator).</li>
                  <li>The registration fee will act as insurance in case of any issues and must be approved by the Welfare Chairperson.</li>
                  <li>Students must ensure that all personal and contact information is updated during registration.</li>
                  <li>Once the form is submitted, the Jumuia (Family) Chairperson will approve the registration request.</li>
                  <li>Students who have not registered for the semester will have limited or no access to reports and other services.</li>
                  <li>Semester registration is conducted only once per semester for all members, whether in or out of session.</li>
                  <li>All Semester registration Amount paid will be Deposited directly to the TUMCATHCOM Treasury and Records kept by the Family Secretary,Welfare Chairperon and SCC Coordinator</li>
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
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form class="needs-validation" action="<?= site_url('/tabs/semester-registration') ?>" method=POST novalidate >
                    <!--begin::Body-->
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Your Name</label>
                          <input
                            type="text"
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
                          <select class="form-select" id="validationCustom04" name="semester_period" required>
                              <option value="" disabled selected>Choose a Progression State...</option>
                              <option value="First Year Student<">First Year Student</option>
                              <option value="Continuing Student">Continuing Student</option>
                              <option value="Finalist">Finalist</option>
                              <option value="Post-Graduate Student">Post-Graduate Student</option>
                          </select>
                          <div class="invalid-feedback">Please choose your progression status.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Payment Phone</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">+254</span>
                            <input
                              type="number"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              placeholder="eg.795751700"
                              name="payphone"
                              required
                            />
                            <div class="invalid-feedback">Please input a Phone Number.</div>
                          </div>
                        </div>
                        <!--end::Col-->
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
                              name="payamount"
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
                          <select class="form-select" id="validationCustom04" required>
                            <option value="<?=$family?>" selected><?=$family?></option>
                        </select>
                          <div class="invalid-feedback">Please select a valid Jumuia.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Semester Period</label>
                        <select class="form-select" id="validationCustom04" name="semester_period" required>
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
                      <button class="btn btn-primary" type="submit">Register for Semester</button>
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