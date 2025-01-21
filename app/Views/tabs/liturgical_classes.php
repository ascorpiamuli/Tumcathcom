<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
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
              <div class="col-sm-6"><h3 class="mb-0">Liturgical Classes Registration</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Liturgical Classes Registration</li>
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
          <?= view('partials/messages') ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-14">
              <div class="card card-primary bg-white card-outline mb-4">
                <div class="card-header">
                  <h2 class="card-title typingEffect">Liturgical Classes Registration Information</h2>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <ul>
                        <li>All participants must complete the previous liturgical class or fulfill any prerequisite requirements before registering for the next class or ministry.</li>
                        <li>Registration for confirmation classes is open to all baptized members of the parish, while non-baptized members should first enroll in the baptismal preparation class.</li>
                        <li>Ministries such as altar serving and liturgical dancing require participants to attend mandatory training sessions prior to active participation.</li>
                        <li>Ministries such as altar serving and liturgical dancing require participants to be Baptised,Confirmed and Ready to Receive the Holy Communion</li>
                        <li>All registrations must be completed within the registration period, which will be announced by the Liturgical Coordinator.</li>
                        <li>The registration fee for liturgical classes or ministries (if applicable) must be approved by the Liturgical Coordinator and paid to the designated TUMCATHCOM Account.</li>
                        <li>Participants must ensure that their personal and guardian contact details are updated during registration.</li>
                        <li>Approval of registration for liturgical classes will be overseen by the Parish Priest or the assigned Catechist.</li>
                        <li>Ministry registrations (e.g., altar servers or liturgical dancers) must be approved by the Liturgical Committee.</li>
                        <li>Failure to register for liturgical classes or ministries will result in limited access to class materials, schedules, and participation privileges.</li>
                        <li>All registration records and payments will be managed by the TUMCATHCOM Secretary, Liturgical Coordinator, and Financial Treasurer.</li>
                        <li>Registered members must actively participate in liturgical events, including masses, rehearsals, and other scheduled parish activities.</li>
                    </ul>
                </div>


                <!-- ./card-body -->
              </div>
              <!-- /.card -->
              <!-- /.col -->
            </div>
            <!--end::Row-->
            <div class="container-fluid">

                <div class="row">
                <div class="col-12">

                <ul class="nav nav-tabs" id="stepTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="false" data-step="catechism">Catechism Registration</button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false" data-step="confirmation">Confirmation Registration</button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false" data-step="altar_servers">Altar Servers Registration</button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="step4-tab" data-bs-toggle="tab" data-bs-target="#step4" type="button" role="tab" aria-controls="step4" aria-selected="false" data-step="liturgical_dancers">Liturgical Dancers Registration</button>
                  </li>
              </ul>
                    <div class="tab-content mt-4" id="stepTabsContent">
                    <!-- Step 1 -->
                    <div class="tab-pane fade show " id="step1" role="tabpanel" aria-labelledby="step1-tab">
            <!--begin::Row-->
            <div class="row g-4">
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title"> Catechism Registration Form</div></div>
                  <div id="catechistContainer">
                      <!-- The pending confirmation message will be appended here -->
                    </div>
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <?= view('partials/messages') ?>
                  <form class="needs-validation" action="<?= site_url('/tabs/liturgical_classes') ?>?registration=step1" method="POST" novalidate >
                    <!--begin::Body-->
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Your Full Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom01"
                            name="yourname"
                            value="<?=$fullName?>"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Phone</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">+254</span>
                            <input
                              type="number"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              value="<?=$userauthprofile['phone_number']?>"
                              name="yourphone"
                              required
                            />
                            <div class="invalid-feedback">Please input a Phone Number.</div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Your Parent/Guardian's Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="guardianname"
                            placeholder="Judith"
                            id="validationCustom01"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Parent/Guardian's Phone</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">+254</span>
                            <input
                              type="number"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              placeholder="797383650"
                              name="guardianphone"
                              required
                            />
                            <div class="invalid-feedback">Please input a Phone Number.</div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Home Diocese</label>
                          <input
                            type="text"
                            class="form-control"
                            name="diocese"
                            id="validationCustom01"
                            placeholder="Catholic Diocese of Kitui"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Home Parish</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom01"
                            placeholder="Mutune Parish"
                            name="parish"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Gender</label>
                        <select class="form-select" id="validationCustom04" name="gender" required>
                            <option value="" disabled selected>Select...</option>
                            <option value="Female<">Female</option>
                            <option value="Male">Male</option>
                            <option value="Custom">Custom</option>
                        </select>
                        <div class="invalid-feedback">Please choose your gender.</div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Date of Birth</label>
                          <input
                            type="date"
                            class="form-control"
                            id="validationCustom01"
                            placeholder="Mutune Parish"
                            value="<?=$userprofile['dob']?>"
                            name="dob"
                            readonly
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Academic Progression Status</label>
                          <select class="form-select" id="validationCustom04" name="progression" required>
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
                          <label for="validationCustom04" class="form-label">Family/Jumuia</label>
                          <select class="form-select" id="validationCustom04" name="family" required>
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
                            I hereby agree to register for Catechism on <?= date('d\t\h F Y'); ?>. By doing so, I acknowledge that I understand the program's guidelines and terms of participation, and I consent to adhere to the rules and regulations set forth by the organization. 
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
                      <button class="btn btn-primary" type="submit" id="submitButton4">Register</button>
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
                    <!-- Step 2 -->

                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                        <!--begin::Row-->
                        <div class="row g-4">
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header"><div class="card-title"> Confirmation Registration Form</div></div>
                            <div id="confirmationContainer">
                              <!-- The pending confirmation message will be appended here -->
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                           
                            <form class="needs-validation" action="<?= site_url('/tabs/liturgical_classes?registration=step2') ?>" method="POST" enctype="multipart/form-data" novalidate >
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
                                        name="yourname"
                                        id="validationCustom01"
                                        value="<?=$fullName?>"
                                        readonly
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustomUsername" class="form-label">Your Phone</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">+254</span>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="validationCustomUsername"
                                        aria-describedby="inputGroupPrepend"
                                        value="<?=$userauthprofile['phone_number']?>"
                                        readonly
                                        name="yourphone"
                                        required
                                        />
                                        <div class="invalid-feedback">Please input a Phone Number.</div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Your Parent/Guardian's Name.</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="validationCustom01"
                                        placeholder="Judith"
                                        name="guardianname"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>                                    
                                    <div class="col-md-6">
                                    <label for="validationCustomUsername" class="form-label">Parent/Guardian's Phone</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">+254</span>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="validationCustomUsername"
                                        aria-describedby="inputGroupPrepend"
                                        placeholder="eg.795751700"
                                        name="guardianphone"
                                        required
                                        />
                                        <div class="invalid-feedback">Please input a Phone Number.</div>
                                    </div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Baptismal Name.</label>
                                    <input
                                        type="text"
                                        name="baptismalname"
                                        class="form-control"
                                        id="validationCustom01"
                                        placeholder="St.Michael"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Gender</label>
                                    <select class="form-select" id="validationCustom04" name="gender" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="Female<">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                    <div class="invalid-feedback">Please choose your gender.</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="baptismalCertificate" class="form-label">
                                            Upload Baptismal Certificate or Card (PDF, max 1MB)
                                        </label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="baptismal_certificate" 
                                            id="baptismal_certificate"
                                            accept=".pdf"
                                            required
                                        />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Your Home Diocese.</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="diocese"
                                        id="validationCustom01"
                                        placeholder="Catholic Diocese of Kitui"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Your Home Parish.</label>
                                    <input
                                        type="text"
                                        name="parish"
                                        class="form-control"
                                        id="validationCustom01"
                                        placeholder="Mutune Parish"
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Academic Progression Status</label>
                                    <select class="form-select" id="validationCustom04" name="progression" required>
                                        <option value="" disabled selected>Choose a Progression State...</option>
                                        <option value="First Year Student<">First Year Student</option>
                                        <option value="Continuing Student">Continuing Student</option>
                                        <option value="Finalist">Finalist</option>
                                        <option value="Post-Graduate Student">Post-Graduate Student</option>
                                    </select>
                                    <div class="invalid-feedback">Please choose your progression status.</div>
                                    </div>
                                    <!--end::Col-->
                                
  
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Family/Jumuia</label>
                                    <select class="form-select" id="validationCustom04"  name="family" required>
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
                                        I hereby agree to register for Confirmation classes on <?= date('d F Y \a\t h:i A'); ?>. By doing so, I acknowledge that I understand the program's guidelines and terms of participation, and I consent to adhere to the rules and regulations set forth by the Catholic Community.
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
                                <button class="btn btn-primary" id="submitButton" type="submit">Register for Confirmation</button>
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
                    <!-- Step 3 -->
                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                                                  <!--begin::Row-->
                        <div class="row g-4">
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header"><div class="card-title">Altar Servers Registration Form</div></div>
                            <div id="serversContainer">
                              <!-- The pending confirmation message will be appended here -->
                            </div>
                            <?= view('partials/messages') ?>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="needs-validation" action="<?= site_url('/tabs/liturgical_classes') ?>?registration=step3" method="POST" novalidate >
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
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Date of Birth</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="validationCustom01"
                                        value="<?=$userprofile['dob']?>"
                                        readonly
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Academic Progression Status</label>
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
                                    <label for="validationCustom04" class="form-label">Gender</label>
                                    <select class="form-select" id="validationCustom04" name="gender" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="Female<">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                    <div class="invalid-feedback">Please choose your gender.</div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustomUsername" class="form-label">Your Phone</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">+254</span>
                                        <input
                                        type="number"
                                        name="phone"
                                        class="form-control"
                                        id="validationCustomUsername"
                                        aria-describedby="inputGroupPrepend"
                                        placeholder="eg.795751700"
                                        value="<?=$userauthprofile['phone_number']?>"
                                        readonly
                                        required
                                        />
                                        <div class="invalid-feedback">Please input a Phone Number.</div>
                                    </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Family/Jumuia</label>
                                    <select class="form-select" id="validationCustom04"name="family" required>
                                        <option value="<?=$family?>" selected><?=$family?></option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid Jumuia.</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Semester Period</label>
                                    <select class="form-select" id="validationCustom04" name="semesterperiod" required>
                                        <option value="" disabled selected>Choose Current Semester...</option>
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
                                        I agree to register as an Altar Server in accordance with the TUMCATHCOM Constitution.
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
                                <button class="btn btn-primary" type="submit" id="buttonSubmit3">Register</button>
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
                    <!-- Step 4 -->
                    <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                                                   <!--begin::Row-->
                        <div class="row g-4">
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header"><div class="card-title">Liturgical Dancers Registration Form</div></div>
                            <div id="dancersContainer">
                              <!-- The pending confirmation message will be appended here -->
                            </div>
                            <?= view('partials/messages') ?>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="needs-validation" action="<?= site_url('/tabs/liturgical_classes') ?>?registration=step4" method="POST" novalidate >
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
                                        name='name'
                                        value="<?=$fullName?>"
                                        readonly
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Date of Birth</label>
                                    <input
                                        type="date"
                                        name="dob"
                                        class="form-control"
                                        id="validationCustom01"
                                        value="<?=$userprofile['dob']?>"
                                        readonly
                                        required
                                    />
                                    <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Academic Progression Status</label>
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
                                    <label for="validationCustom04" class="form-label">Gender</label>
                                    <select class="form-select" id="validationCustom04" name="gender" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="Female<">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                    <div class="invalid-feedback">Please choose your gender.</div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustomUsername" class="form-label">Your Phone</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">+254</span>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="validationCustomUsername"
                                        aria-describedby="inputGroupPrepend"
                                        placeholder="eg.795751700"
                                        value="<?=$userauthprofile['phone_number']?>"
                                        readonly
                                        name="phone"
                                        required
                                        />
                                        <div class="invalid-feedback">Please input a Phone Number.</div>
                                    </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Family/Jumuia</label>
                                    <select class="form-select" id="validationCustom04" name="family" required>
                                        <option value="<?=$family?>" selected><?=$family?></option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid Jumuia.</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Semester Period</label>
                                    <select class="form-select" id="validationCustom04" name="semesterperiod" required>
                                        <option value="" disabled selected>Choose Current Semester...</option>
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
                                        I agree to register as a Liturgical Dancer in accordance with the TUMCATHCOM Constitution.
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
                                <button class="btn btn-primary" id="submitButton2" type="submit">Register</button>
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
                    </div>
                </div>
                </div>
            </div>
          <!--begin::Container-->
          <div class="container-fluid">
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
<?= $this->endSection() ?>
<?=$this->section('scripts')?>
<script>
// Assuming the values are stored as 1 (true) and 0 (false) in the database
var isBaptised = <?php echo $userprofile['baptized']; ?>;  // 1 for true, 0 for false
var isConfirmed = <?php echo $userprofile['confirmed']; ?>;  // 1 for true, 0 for false

window.onload = function() {
    // Disable the Confirmation Registration tab if the user is confirmed (isConfirmed == 1)
    if (isConfirmed === 1) {
        document.getElementById('step2-tab').disabled = true;
        document.getElementById('step2-tab').classList.add('disabled'); // Optional: to visually indicate the tab is disabled
    }
    if (isBaptised === 0 && isConfirmed === 0) {
        document.getElementById('step2-tab').disabled = true;
        document.getElementById('step3-tab').disabled = true;
        document.getElementById('step2-tab').classList.add('disabled'); // Optional: to visually indicate the tab is disabled
        document.getElementById('step3-tab').classList.add('disabled');
    }

    // Disable the Catechism Registration tab if the user is baptised but not confirmed (isBaptised == 1 && isConfirmed == 0)
    if (isBaptised === 1 && isConfirmed === 0) {
        document.getElementById('step1-tab').disabled = true;
        document.getElementById('step3-tab').disabled = true;
        document.getElementById('step1-tab').classList.add('disabled'); // Optional: to visually indicate the tab is disabled
    }

    // Disable both if both are true (isBaptised == 1 && isConfirmed == 1)
    if (isBaptised === 1 && isConfirmed === 1) {
        document.getElementById('step1-tab').disabled = true;
        document.getElementById('step2-tab').disabled = true;
        document.getElementById('step1-tab').classList.add('disabled'); // Optional: to visually indicate the tab is disabled
        document.getElementById('step2-tab').classList.add('disabled'); // Optional: to visually indicate the tab is disabled
    }

    // Determine which tab to make active
    var firstEnabledTab = null;

    // Check for the first enabled tab
    if (!document.getElementById('step1-tab').disabled) {
        firstEnabledTab = 'step1';
    } else if (!document.getElementById('step2-tab').disabled) {
        firstEnabledTab = 'step2';
    } else if (!document.getElementById('step3-tab').disabled) {
        firstEnabledTab = 'step3';
    } else if (!document.getElementById('step4-tab').disabled) {
        firstEnabledTab = 'step4';
    }

    // Activate the first enabled tab
    if (firstEnabledTab) {
        document.getElementById(firstEnabledTab + '-tab').classList.add('active');
        document.getElementById(firstEnabledTab).classList.add('show', 'active');
    }

    // Update the URL when the page loads to reflect the active tab (based on existing URL or default if none)
    var urlParams = new URLSearchParams(window.location.search);
    var registrationStep = urlParams.get('registration') || firstEnabledTab; // Default to the first enabled tab if none is specified
    history.pushState(null, '', `?registration=${registrationStep}`);

};

</script>
<script>
  // Check the status of the confirmation request
  var status = "<?php echo isset($confirmationdata['status']) ? $confirmationdata['status'] : 'null'; ?>";
  //for liturgical dancers
  var status2 = "<?php echo isset($dancersdata['status']) ? $dancersdata['status'] : 'null'; ?>";
  var status3 = "<?php echo isset($serversdata['status']) ? $serversdata['status'] : 'null'; ?>";
  var status4 = "<?php echo isset($catechistdata['status']) ? $catechistdata['status'] : 'null'; ?>";
  if (status3) {
    
    // Create a div for the confirmation message
    var statusDiv = document.createElement('div');
    
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    var icon = document.createElement('span');
    icon.style.marginRight = '10px';

    var message = document.createElement('span');

    // Set styles and messages based on status
    switch (status3.toLowerCase()) {
      case 'pending':
        statusDiv.style.backgroundColor = '#ffcc80'; // Orange
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#d35400';
        icon.innerHTML = '&#128712;'; // Hourglass icon ⌛
        message.innerHTML = `
          <strong>Pending Confirmation:</strong> Your registration is under confirmation. 
          Please wait for approval, which will take less than 48 hours. Approval is done by the Liturgical Coordinator.

        `;
        console.log(message);
        
        break;
      case 'approved':
        statusDiv.style.backgroundColor = '#d4edda'; // Green
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#155724';
        icon.innerHTML = '&#9989;'; // Checkmark ✅
        message.innerHTML = `
          <strong>Approved:</strong> Your Confirmation registration has been approved.Please wait for Class Schedule From the Liturgy Committee.
        `;
        break;
      case 'declined':
        statusDiv.style.backgroundColor = '#f8d7da'; // Red
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#721c24';
        icon.innerHTML = '&#10060;'; // Cross ❌
        message.innerHTML = `
          <strong>Declined:</strong> Your registration has been declined. Please contact Liturgical Office.
        `;
        break;
      default:
        console.error('Unknown status:', status);
        break;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the div to a target container
    var targetContainer = document.getElementById('serversContainer');
    console.log(targetContainer);
    
    if (targetContainer) {
      targetContainer.appendChild(statusDiv);
    } else {
      console.error("Target container for status message not found.");
    }

    // Disable the form submission button if status is pending
    if (status3.toLowerCase() === 'pending' || status3.toLowerCase()==='approved') {
      var submitButton = document.getElementById('buttonSubmit3');
      if (submitButton) {
        submitButton.disabled = true;
      } else {
        console.error("Submit button not found.");
      }
    }
  }
  if (status2) {
    // Create a div for the confirmation message
    var statusDiv = document.createElement('div');
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    var icon = document.createElement('span');
    icon.style.marginRight = '10px';

    var message = document.createElement('span');

    // Set styles and messages based on status
    switch (status2.toLowerCase()) {
      case 'pending':
        statusDiv.style.backgroundColor = '#ffcc80'; // Orange
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#d35400';
        icon.innerHTML = '&#128712;'; // Hourglass icon ⌛
        message.innerHTML = `
          <strong>Pending Confirmation:</strong> Your registration is under confirmation. 
          Please wait for approval, which will take less than 48 hours. Approval is done by the Liturgical Coordinator.

        `;
        break;
      case 'approved':
        statusDiv.style.backgroundColor = '#d4edda'; // Green
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#155724';
        icon.innerHTML = '&#9989;'; // Checkmark ✅
        message.innerHTML = `
          <strong>Approved:</strong> Your Confirmation registration has been approved.Please wait for Class Schedule From the Liturgy Committee.
        `;
        break;
      case 'declined':
        statusDiv.style.backgroundColor = '#f8d7da'; // Red
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#721c24';
        icon.innerHTML = '&#10060;'; // Cross ❌
        message.innerHTML = `
          <strong>Declined:</strong> Your registration has been declined. Please contact Liturgical Office.
        `;
        break;
      default:
        console.error('Unknown status:', status);
        break;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the div to a target container
    var targetContainer = document.getElementById('dancersContainer');
    if (targetContainer) {
      targetContainer.appendChild(statusDiv);
    } else {
      console.error("Target container for status message not found.");
    }

    // Disable the form submission button if status is pending
    if (status2.toLowerCase() === 'pending' || status2.toLowerCase()==='approved') {
      var submitButton = document.getElementById('submitButton2');
      if (submitButton) {
        submitButton.disabled = true;
      } else {
        console.error("Submit button not found.");
      }
    }
  }
  if (status) {
    // Create a div for the confirmation message
    var statusDiv = document.createElement('div');
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    var icon = document.createElement('span');
    icon.style.marginRight = '10px';

    var message = document.createElement('span');

    // Set styles and messages based on status
    switch (status.toLowerCase()) {
      case 'pending':
        statusDiv.style.backgroundColor = '#ffcc80'; // Orange
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#d35400';
        icon.innerHTML = '&#128712;'; // Hourglass icon ⌛
        message.innerHTML = `
          <strong>Pending Confirmation:</strong> Your registration is under confirmation. 
          Please wait for approval, which will take less than 48 hours. Approval is done by the Liturgical Coordinator.

        `;
        break;
      case 'approved':
        statusDiv.style.backgroundColor = '#d4edda'; // Green
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#155724';
        icon.innerHTML = '&#9989;'; // Checkmark ✅
        message.innerHTML = `
          <strong>Approved:</strong> Your Confirmation registration has been approved.Please wait for Class Schedule From the Liturgy Committee.
        `;
        break;
      case 'declined':
        statusDiv.style.backgroundColor = '#f8d7da'; // Red
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#721c24';
        icon.innerHTML = '&#10060;'; // Cross ❌
        message.innerHTML = `
          <strong>Declined:</strong> Your registration has been declined. Please contact Liturgical Office.
        `;
        break;
      default:
        console.error('Unknown status:', status);
        break;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the div to a target container
    var targetContainer = document.getElementById('confirmationContainer');
    if (targetContainer) {
      targetContainer.appendChild(statusDiv);
    } else {
      console.error("Target container for status message not found.");
    }

    // Disable the form submission button if status is pending
    if (status.toLowerCase() === 'pending' || status.toLowerCase()==='approved') {
      var submitButton = document.getElementById('submitButton');
      if (submitButton) {
        submitButton.disabled = true;
      } else {
        console.error("Submit button not found.");
      }
    }
  }
  if (status4) {
    // Create a div for the confirmation message
    var statusDiv = document.createElement('div');
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    var icon = document.createElement('span');
    icon.style.marginRight = '10px';

    var message = document.createElement('span');

    // Set styles and messages based on status
    switch (status4.toLowerCase()) {
      case 'pending':
        statusDiv.style.backgroundColor = '#ffcc80'; // Orange
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#d35400';
        icon.innerHTML = '&#128712;'; // Hourglass icon ⌛
        message.innerHTML = `
          <strong>Pending Confirmation:</strong> Your registration is under confirmation. 
          Please wait for approval, which will take less than 48 hours. Approval is done by the Liturgical Coordinator.

        `;
        break;
      case 'approved':
        statusDiv.style.backgroundColor = '#d4edda'; // Green
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#155724';
        icon.innerHTML = '&#9989;'; // Checkmark ✅
        message.innerHTML = `
          <strong>Approved:</strong> Your Confirmation registration has been approved.Please wait for Class Schedule From the Liturgy Committee.
        `;
        break;
      case 'declined':
        statusDiv.style.backgroundColor = '#f8d7da'; // Red
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#721c24';
        icon.innerHTML = '&#10060;'; // Cross ❌
        message.innerHTML = `
          <strong>Declined:</strong> Your registration has been declined. Please contact Liturgical Office.
        `;
        break;
      default:
        console.error('Unknown status:', status);
        break;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the div to a target container
    var targetContainer = document.getElementById('catechistContainer');
    if (targetContainer) {
      targetContainer.appendChild(statusDiv);
    } else {
      console.error("Target container for status message not found.");
    }

    // Disable the form submission button if status is pending
    if (status4.toLowerCase() === 'pending' || status4.toLowerCase()==='approved') {
      var submitButton = document.getElementById('submitButton4');
      if (submitButton) {
        submitButton.disabled = true;
      } else {
        console.error("Submit button not found.");
      }
    }
  }
</script>



<script>
    // Listen for tab clicks
    const tabs = document.querySelectorAll('.nav-link');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (event) {
            const selectedTab = event.target;
            const step = selectedTab.getAttribute('data-bs-target').replace('#', ''); // Get the data-bs-target attribute and remove #

            // Dynamically change the URL based on the selected tab
            history.pushState(null, '', `?registration=${step}`);
        });
    });
</script>




<?=$this->endSection()?>
<?= $this->endSection() ?>