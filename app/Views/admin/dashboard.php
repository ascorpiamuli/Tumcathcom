<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?=base_url('/assets/css/dashboard-content.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">

            <?= view('partials/messages') ?>
              <div class="col-sm-6"><h3 class="mb-0"><?=isset($admindata['position'])?$admindata['position']:'K'?>'s Portal</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?=site_url('/admin/dashboard')?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-6">
              <div class="card mb-4 shadow-sm">
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="bi bi-bar-chart-line"></i> Semester Registration Statistics</h3>
                    <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                        <i class="bi bi-file-earmark-bar-graph"></i> View Report
                    </a>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="d-flex flex-column">
                            <span class="fw-bold fs-5"><i class="bi bi-person-fill text-primary"></i> <?=htmlspecialchars($registeredmembers)?></span>
                            <span class="text-muted">Members Registered</span>
                        </p>
                        <p class="text-end">
                            <span class="text-success fw-bold"><i class="bi bi-arrow-up"></i> <?=htmlspecialchars($weeklypercentregistration)?>%</span>
                            <br>
                            <span class="text-secondary">Since last week</span>
                        </p>
                    </div>

                    <!-- Chart Section -->
                    <div class="position-relative mb-4">
                        <div id="visitors-chart"></div>
                    </div>

                    <!-- Legend -->
                    <div class="d-flex justify-content-end">
                        <span class="me-3"><i class="bi bi-square-fill text-primary"></i> This Week</span>
                        <span><i class="bi bi-square-fill text-secondary"></i> Last Week</span>
                    </div>
                </div>
            </div>
                <div class="card mb-4 bg-white">
                    <div class="card-header border-0">
                      <h3 class="card-title">Approve Your Admins</h3>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped align-middle">
                          <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                            <tr>
                              <th style="width: 25%;">Name</th>
                              <th style="width: 20%;">Position</th>
                              <th style="width: 20%;">Dept ID</th>
                              <th style="width: 15%;">Status</th>
                              <th style="width: 20%;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($alladmindata as $admin) : ?>
                              <tr>
                                <td><?= htmlspecialchars($admin['first_name']) . ' ' . htmlspecialchars($admin['last_name']) ?></td>
                                <td><?= htmlspecialchars($admin['position']) ?></td>
                                <td><?= htmlspecialchars($admin['departmental_id']) ?></td>
                                <td>
                                  <?php if ($admin['suspended'] == 1) : ?>
                                    <span class="badge bg-danger">Suspended</span>
                                  <?php elseif($admin['approval']==1) : ?>
                                    <span class="badge bg-success">Approved</span>
                                  <?php elseif($admin['approval']==0 && $admin['suspended']==0): ?>
                                    <span class="badge bg-warning">Pending</span>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <div class="d-flex gap-2">
                                    <?php if ($admin['approval'] == 0) : ?>
                                      <a href="<?= site_url('approve/' . $admin['admin_id']) ?>" class="btn btn-sm btn-success">Approve</a>
                                      <a href="<?= site_url('decline/' . $admin['admin_id']) ?>" class="btn btn-sm btn-danger">Decline</a>
                                    <?php else : ?>
                                      <button class="btn btn-sm btn-secondary" style="display:none" disabled>Approved</button>
                                      <?php if ($admin['suspended'] == 1) : ?>
                                        <a href="<?= site_url('reinstate/' . $admin['admin_id']) ?>" class="btn btn-sm btn-secondary">Reinstate</a>
                                    <?php else: ?>
                                    <a href="<?= site_url('suspend/' . $admin['admin_id']) ?>" class="btn btn-sm btn-danger">Suspend</a>                                     
                                    <?php endif;?>
                                    <?php endif; ?>
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
                    <div class="card bg-white text-black mb-6">
                        <div class="card-header">
                            <h3 class="card-title">Main Office</h3>
                            <div class="card-tools">
                                <span class="badge text-bg-warning"><?=htmlspecialchars($alladmins-$approvedadmins)?> Admins Pending</span>
                                <span class="badge text-bg-success"><?=htmlspecialchars($approvedadmins)?> Admins Approved</span>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="container">
                                <!-- Row 1 (4 Members) -->
                                <div class="row text-center">
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Jerome Wekesa</a>
                                        <div class="fs-8">Chairperson</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle"  src="../../dist/assets/img/user4-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Cynthia Chelangat</a>
                                        <div class="fs-8">Vice Chair</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user7-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Mary Syokau</a>
                                        <div class="fs-8">Secretary</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle"  src="../../dist/assets/img/user4-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Stacy Nzula</a>
                                        <div class="fs-8">Vice Sec.</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user2-160x160.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Boaz Kiplangat</a>
                                        <div class="fs-8">Treasurer</div>
                                    </div>
                                    
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Thuo Francis</a>
                                        <div class="fs-8">Assets.M</div>
                                    </div>
                                    
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Levis Miheso</a>
                                        <div class="fs-8">SCC.C</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user4-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Helena Faith</a>
                                        <div class="fs-8">Hospitality Manager</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Emmanuel Adrian</a>
                                        <div class="fs-8">Liturgical Coordinator</div>
                                    </div>
                                    <div class="col-2 p-2">
                                        <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image">
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">Arnold Onguti</a>
                                        <div class="fs-8">Organizing Secretary</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="javascript:" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View All Leaders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <div class="card direct-chat direct-chat-primary mb-5 mt-5">
                      <div class="card-header bg-primary">
                          <h3 class="card-title">Drop Your Suggestions (Public)</h3>
                      </div>
                      <div class="card-body">
                          <div class="direct-chat-messages" id="suggestionMessages">
                              <!-- Suggestions will load here dynamically -->
                          </div>
                      </div>
                      <div class="card-footer">
                          <div class="input-group">
                              <input type="text" id="suggestionMessage" placeholder="Type your suggestion..." class="form-control" />
                              <input type="hidden" id="sessionUserId" value="<?=isset($admindata['admin_id'])?$admindata['admin_id']:$userprofile['user_id']?>">
                              <span class="input-group-append">
                                  <button type="button" class="btn btn-primary" id="sendSuggestion">Send</button>
                              </span>
                          </div>
                      </div>
                  </div>

                      <!-- ACTIVITY LOG -->
                      <div class="card mb-4 mt-6" style="display:none">
                        <div class="card-header border-0 bg-success text-white">
                            <h3 class="card-title">Activity Log</h3>
                        </div>
                        <div class="card-body p-0" style="max-height: 250px; overflow-y: auto;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-check-circle text-success me-2"></i> John updated profile</div>
                                    <small class="text-muted">10 mins ago</small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-cart text-primary me-2"></i> New order by Alice</div>
                                    <small class="text-muted">30 mins ago</small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-pencil text-warning me-2"></i> Bob edited a post</div>
                                    <small class="text-muted">1 hour ago</small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-upload text-danger me-2"></i> Charlie uploaded a file</div>
                                    <small class="text-muted">2 hours ago</small>
                                </li>
                            </ul>
                        </div>
                    </div>
              </div>
          <div class="col-lg-6">
            <div class="card mb-2">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="bi bi-bar-chart-line-fill"></i> Assets Statistics
                        </h3>
                        <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                            <i class="bi bi-file-earmark-bar-graph"></i> View Report
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <span class="fw-bold fs-5">
                                <i class="bi bi-cash-stack text-success typingEffect"></i> Revenue: Ksh <?= htmlspecialchars($registrationfeetotal) ?>
                            </span>
                            <span class="fw-bold fs-5">
                                <i class="bi bi-credit-card-2-back-fill text-danger typingEffect"></i> Expenses: Ksh <?= htmlspecialchars('5,000') ?>
                            </span>
                            <hr class="my-2">
                            <span>
                                <i class="bi bi-check-circle-fill text-primary typingEffect"></i> Approved Bookings: <?= htmlspecialchars($assetshired) ?>
                            </span>
                            <span>
                                <i class="bi bi-hourglass-split text-warning typingEffect"></i> Pending Bookings: <?= htmlspecialchars($assetspending) ?>
                            </span>
                            <span>
                                <i class="bi bi-x-circle-fill text-danger" typingEffect></i> Declined Bookings: <?= htmlspecialchars($assetsdeclined) ?>
                            </span>
                        </div>

                        <div class="text-end">
                            <span class="text-success fw-bold fs-5">
                                <i class="bi bi-arrow-up"></i> 12.1%
                            </span>
                            <br>
                            <span class="text-secondary">Percentage Profit</span>
                        </div>
                    </div>
                    </div>
                    </div>
                        <div class="card mb-2">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title typingEffect">Treasury Statistics</h3>
                                    <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                        View Report
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="d-flex flex-column">
                                        <span class="fw-bold fs-5"><i class="bi bi-piggy-bank text-success typingEffect"></i> KES <?=htmlspecialchars('250,000')?></span>
                                        <span class="text-muted">Current Balance</span>
                                    </p>
                                    <p class="text-end">
                                        <span class="text-success fw-bold"><i class="bi bi-arrow-up"></i> 33.1%</span>
                                        <br>
                                        <span class="text-secondary">Since Jan 2024</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between my-3">
                                    <span class="text-success"><i class="bi bi-cash-coin"></i> Total Revenue: KES <?=htmlspecialchars('1,200,000')?></span>
                                    <span class="text-danger"><i class="bi bi-credit-card-2-back-fill"></i> Total Expenses: KES <?=htmlspecialchars('950,000')?></span>
                                </div>

                                <div class="position-relative mb-4">
                                    <div id="sales-chart"></div>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="me-2">
                                        <i class="bi bi-square-fill text-primary"></i> This year
                                    </span>
                                    <span>
                                        <i class="bi bi-square-fill text-secondary"></i> Last year
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-header border-0 d-flex justify-content-between align-items-center">
                              <h3 class="card-title">Liturgical Registration Reports</h3>
                              <div class="card-tools">
                                  <a href="#" class="btn btn-sm btn-tool"><i class="bi bi-download"></i></a>
                                  <a href="#" class="btn btn-sm btn-tool"><i class="bi bi-list"></i></a>
                              </div>
                          </div>
                <div class="card-body">
                    <!-- Catechism Registration -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success fs-2">
                            <i class="bi bi-person-check-fill"></i>
                        </p>
                        <p class="d-flex flex-column text-end">
                            <span class="fw-bold">
                                <i class="bi bi-graph-up-arrow text-success"></i> 
                                <span id="catechismMembers"><?=htmlspecialchars($catechismmembers)?></span> Member(s) Registered
                            </span>
                            <span class="text-secondary">CATECHISM REGISTRATION</span>
                        </p>
                    </div>

                    <!-- Liturgical Dancers & Altar Servers -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-info fs-2">
                            <i class="bi bi-people-fill"></i>
                        </p>
                        <p class="d-flex flex-column text-end">
                            <span class="fw-bold">
                                <i class="bi bi-graph-up-arrow text-info"></i> 
                                <span id="liturgicalMembers"><?=htmlspecialchars($serversmembers + $dancersmembers)?></span> Member(s) Registered
                            </span>
                            <span class="text-secondary">LITURGICAL DANCERS & ALTAR SERVERS</span>
                        </p>
                    </div>

                    <!-- Confirmation Registration -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-primary fs-2">
                            <i class="bi bi-shield-lock-fill"></i>
                        </p>
                        <p class="d-flex flex-column text-end">
                            <span class="fw-bold">
                                <i class="bi bi-graph-up-arrow text-primary"></i> 
                                <span id="confirmationMembers"><?=htmlspecialchars($confirmationmembers)?></span> Member(s) Registered
                            </span>
                            <span class="text-secondary">CONFIRMATION REGISTRATIONS</span>
                        </p>
                    </div>

                    <!-- Choir Registration -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning fs-2">
                            <i class="bi bi-music-note-list"></i>
                        </p>
                        <p class="d-flex flex-column text-end">
                            <span class="fw-bold">
                                <i class="bi bi-graph-up-arrow text-warning"></i> 
                                <span id="choirMembers">47</span> Member(s) Registered
                            </span>
                            <span class="text-secondary">CHOIR REGISTRATION</span>
                        </p>
                    </div>
                </div>
            </div>
              <div class="card mt-2 shadow-lg border-0 rounded-3">
                  <div class="card-header bg-info text-black d-flex align-items-center justify-content-between">
                      <h3 class="card-title mb-0"><i class="bi bi-people-fill"></i> <?= count($onlineadmins) ?> Members Online in the Last 24 Hours </h3>
                  </div>
                  <div class="card-body p-0">
                      <div class="scrollable-container">
                          <table class="table table-hover table-striped align-middle custom-table">
                              <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                  <tr>
                                      <th style="width: 35%;">Name</th>
                                      <th style="width: 15%;">Status</th>
                                      <th style="width: 20%;">Last Seen</th>
                                      <th style="width: 30%;">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($onlineadmins as $admin): ?>
                                      <?php
                                      // Calculate online status based on `updated_at`
                                      $lastActivity = strtotime($admin['updated_at']);
                                      $currentTime = time();
                                      $timeDiff = $currentTime - $lastActivity;

                                      $hoursAgo = floor($timeDiff / 3600); // Convert to hours
                                      $minutesAgo = floor(($timeDiff % 3600) / 60); // Remaining minutes

                                      if ($timeDiff <= 300) { // Active if last activity within 5 minutes
                                          $status = "Active";
                                          $badgeClass = "bg-success";
                                          $iconClass = "text-success pulse-animation"; // Add pulse animation
                                          $lastSeenText = "Just now";
                                      } elseif ($timeDiff <= 900) { // Idle if last activity within 15 minutes
                                          $status = "Idle";
                                          $badgeClass = "bg-warning";
                                          $iconClass = "text-warning";
                                          $lastSeenText = "$minutesAgo min ago";
                                      } else { // Offline if last activity is older
                                          $status = "Offline";
                                          $badgeClass = "bg-secondary";
                                          $iconClass = "text-danger";
                                          
                                          if ($hoursAgo >= 1) {
                                              $lastSeenText = "$hoursAgo hr $minutesAgo min ago";
                                          } else {
                                              $lastSeenText = "$minutesAgo min ago";
                                          }
                                      }
                                      ?>
                                      <tr>
                                          <td class="d-flex align-items-center">
                                              <i class="bi bi-person-circle fs-3 <?= $iconClass ?> me-3"></i> 
                                              <span class="fw-bold"><?= esc($admin['full_name']) ?></span>
                                          </td>
                                          <td><span class="badge <?= $badgeClass ?> px-3 py-2"><i class="bi bi-dot"></i> <?= $status ?></span></td>
                                          <td class="text-muted fw-semibold"><?= $lastSeenText ?></td>
                                          <td>
                                              <button class="btn btn-sm <?= $status === 'Offline' ? 'btn-secondary' : 'btn-primary' ?>" <?= $status === 'Offline' ? 'disabled' : '' ?>>
                                                  <i class="bi bi-chat-dots"></i> Message
                                              </button>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              </div>
              <!-- /.col-md-6 -->
            </div>
                <!--begin::Latest Order Widget-->
                <div class="card m-2">
                  <div class="card-header bg-white">
                      <h3 class="card-title">Latest Bookings (Assets)</h3>
                  </div>
                  <div class="card-body p-0">
                  <div class="table-responsive" style="max-height: 500px; overflow-y: auto; overflow-x: auto; white-space: nowrap;">
                            <table class="table table-striped table-bordered">
                              <thead class="table-light">
                              <tr>
                                <th>#</th>
                                <th>Booking ID</th>
                                <th>Assets Booked</th>
                                <th>Location</th>
                                <th>Date Booked</th>
                                <th>Booked By</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                                  <?php 
                                  if (empty($pendingassets)): ?>
                                      <tr>
                                          <td colspan="9" class="text-center"><strong>No Pending Bookings available.</strong></td>
                                      </tr>
                                  <?php else: 
                                      $groupedBookings = [];

                                      foreach ($pendingassets as $booking) {
                                          $bookingId = $booking['booking_id'];
                                          if (!isset($groupedBookings[$bookingId])) {
                                              $groupedBookings[$bookingId] = [
                                                  'booking_id' => $bookingId,
                                                  'location' => $booking['location'],
                                                  'booking_start_date' => $booking['booking_start_date'],
                                                  'booked_by' => $booking['booked_by'],
                                                  'booking_end_date' => $booking['booking_end_date'],
                                                  'booking_status' => $booking['booking_status'],
                                                  'assets_count' => 0
                                              ];
                                          }
                                          $groupedBookings[$bookingId]['assets_count']++;
                                      }

                                      $counter = 1;

                                      foreach ($groupedBookings as $booking): ?>
                                          <tr>
                                              <td><?= $counter++ ?>.</td>
                                              <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                                              <td><?= $booking['assets_count'] ?></td>
                                              <td><?= htmlspecialchars($booking['location']) ?></td>
                                              <td><?= htmlspecialchars($booking['booking_start_date']) ?></td>
                                              <td><?= htmlspecialchars($booking['booked_by']) ?></td>
                                              <td><?= htmlspecialchars($booking['booking_end_date']) ?></td>
                                              <td>
                                                  <span class="badge text-bg-<?= strtolower($booking['booking_status']) == 'pending' ? 'warning' : (strtolower($booking['booking_status']) == 'approved' ? 'success' : 'danger') ?>">
                                                      <?= ucfirst($booking['booking_status']) ?>
                                                  </span>
                                              </td>
                                              <td>
                                              <?php if (strtolower($booking['booking_status']) == 'pending'): ?>
                                                  <button class="btn btn-success btn-sm approve-btn" data-id="<?= $booking['booking_id'] ?>">Approve</button>
                                                  <button class="btn btn-danger btn-sm decline-btn" data-id="<?= $booking['booking_id'] ?>">Decline</button>
                                              <?php else: ?>
                                                  <button class="btn btn-success btn-sm" disabled style="opacity: 0.5;">Approve</button>
                                                  <button class="btn btn-danger btn-sm" disabled style="opacity: 0.5;">Decline</button>
                                              <?php endif; ?>
                                                  <button class="btn btn-info btn-sm view-assets-btn" data-id="<?= $booking['booking_id'] ?>">View Assets</button>
                                              </td>
                                          </tr>
                                          <!-- Hidden row for asset details -->
                                          <tr id="assets-details-<?= $booking['booking_id'] ?>" class="assets-details" style="display: none;">
                                              <td colspan="9">
                                                  <div>
                                                      <h5>Assets for Booking ID: <?= htmlspecialchars($booking['booking_id']) ?></h5>
                                                      <div class="text-center">
                                                          <div class="spinner-border text-primary" style="display: none;"></div>
                                                      </div>
                                                      <table class="table table-bordered">
                                                          <thead>
                                                              <tr>
                                                                  <th>Asset Name</th>
                                                                  <th>Asset Type</th>
                                                                  <th>Asset Quantity</th>
                                                                  <th>Asset Condition</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody class="assets-table-body">
                                                              <!-- Asset details will be dynamically inserted here -->
                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </td>
                                          </tr>
                                      <?php endforeach;
                                  endif; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>

        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::App Main-->
      <main class="app-main">
        <div class="app-content">
          <!--begin::Container-->
            <!--begin::Row-->
            <div class="row">
            <div class="col-md-12">
             <div class="card shadow-lg rounded-lg">
              <div class="card-header d-flex justify-content-between align-items-center bg-white text-black">
                <h5 class="card-title mb-0">Community Treasury Report</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-light btn-sm" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="bi bi-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="#" class="dropdown-item">Download Report</a>
                      <a href="#" class="dropdown-item">Export Data</a>
                      <a href="#" class="dropdown-item">Settings</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-light btn-sm" data-lte-toggle="card-remove">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center fw-bold">Report Date: <span class="text-primary">February 14, 2025</span></p>
                    <canvas id="revenueChart"></canvas>
                  </div>
                  <div class="col-md-4">
                    <p class="text-center fw-bold">Major Revenue Earners</p>
                    <ul class="list-group">
                      <li class="list-group-item">Semester Registrations (SCC Department): <strong>160/200</strong></li>
                      <li class="list-group-item">Assets Department: <strong>310/400</strong></li>
                      <li class="list-group-item">Organizing Department: <strong>480/800</strong></li>
                      <li class="list-group-item">Miscellaneous: <strong>250/500</strong></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-light">
                <div class="row text-center">
                  <div class="col-md-3 col-6 border-end">
                    <span class="text-success"><i class="bi bi-caret-up-fill"></i> 17%</span>
                    <h5 class="fw-bold mb-0 text-dark">$35,210.43</h5>
                    <small class="text-uppercase text-muted">Total Revenue</small>
                  </div>
                  <div class="col-md-3 col-6 border-end">
                    <span class="text-info"><i class="bi bi-caret-left-fill"></i> 0%</span>
                    <h5 class="fw-bold mb-0 text-dark">$10,390.90</h5>
                    <small class="text-uppercase text-muted">Total Cost</small>
                  </div>
                  <div class="col-md-3 col-6 border-end">
                    <span class="text-success"><i class="bi bi-caret-up-fill"></i> 20%</span>
                    <h5 class="fw-bold mb-0 text-dark">$24,813.53</h5>
                    <small class="text-uppercase text-muted">Total Profit</small>
                  </div>
                  <div class="col-md-3 col-6">
                    <span class="text-danger"><i class="bi bi-caret-down-fill"></i> 18%</span>
                    <h5 class="fw-bold mb-0 text-dark">$1,200</h5>
                    <small class="text-uppercase text-muted">Transaction Costs</small>
                  </div>
                </div>
              </div>
          </div>
        </div>
        </div>

        </div>
        </div>

              <!-- /.col -->
            </div>
            <!--end::Row-->
          <!--end::Container-->
        </div>
        <!--end::App Content-->
        
      </main>
      <!--end::App Main-->
<?= $this->endSection() ?>
<?= $this->section('scripts')?>


<?= $this->endSection() ?>


