<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-title">Treasury Report</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-tool dropdown-toggle"
                          data-bs-toggle="dropdown"
                        >
                          <i class="bi bi-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                          <a href="#" class="dropdown-item">Action</a>
                          <a href="#" class="dropdown-item">Another action</a>
                          <a href="#" class="dropdown-item"> Something else here </a>
                          <a class="dropdown-divider"></a>
                          <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-8">
                        <p class="text-center">
                          <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                        </p>
                        <div id="sales-chart"></div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center"><strong>Goal Completion</strong></p>
                        <div class="progress-group">
                          Add Products to Cart
                          <span class="float-end"><b>160</b>/200</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: 80%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Complete Purchase
                          <span class="float-end"><b>310</b>/400</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: 75%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Visit Premium Page</span>
                          <span class="float-end"><b>480</b>/800</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: 60%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Send Inquiries
                          <span class="float-end"><b>250</b>/500</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-warning" style="width: 50%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 17%
                          </span>
                          <h5 class="fw-bold mb-0">$35,210.43</h5>
                          <span class="text-uppercase">TOTAL REVENUE</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span>
                          <h5 class="fw-bold mb-0">$10,390.90</h5>
                          <span class="text-uppercase">TOTAL COST</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 20%
                          </span>
                          <h5 class="fw-bold mb-0">$24,813.53</h5>
                          <span class="text-uppercase">TOTAL PROFIT</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-danger">
                            <i class="bi bi-caret-down-fill"></i> 18%
                          </span>
                          <h5 class="fw-bold mb-0">1200</h5>
                          <span class="text-uppercase">GOAL COMPLETIONS</span>
                        </div>
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
<?= $this->endSection() ?>