<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?=base_url('/assets/css/dashboard-content.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="row welcome-section">
            <div class="col-12 text-center">
                <?php if ($fullName && $family): ?>
                    <h2>Karibu, <?= esc($fullName) ?>.</h2>
                <?php else: ?>
                    <p>No family information available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Row 1: Family Details, Prayers, and Assets -->
        <div class="row">
            <div class="col-12 col-md-4">
                <!-- Family Details -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/family') ?>" class="box family-details">
                        <i class="fas fa-users fa-3x"></i> <!-- Family Icon -->
                        <h3></strong> <?= esc($family) ?></h3>
                        <div class="saint-box" onclick="viewSaintDetails('<?= esc($saint) ?>')">
                            <p><?= esc(substr($saint, 0, 100)) ?>...</p> <!-- Show the first 100 characters -->
                           
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <!-- Prayers -->
                <div class="box-container" >
                    <a href="<?= site_url('tabs/daily_prayers/' . $prayer['id']) ?>" class="box prayers">
                        <i class="fas fa-praying-hands fa-3x"></i> <!-- Prayers Icon -->
                        <h3><?= $prayer['title'] ?></h3>
                        <p><?= esc(substr($prayer['content'], 0, 100)) ?>...</p>
                        <p><?= $prayer['id'] ?></p>
                    </a>

                </div>
            </div>

            <div class="col-12 col-md-4">
                <!-- Daily Readings Section -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/readings') ?>" class="box daily-readings">
                        <i class="fas fa-book fa-3x"></i> <!-- Book Icon -->
                        <h3>Daily Readings</h3>
                        <?php if (!empty($readings['content'])): ?>
                            <?php foreach ($readings['content'] as $reading): ?>
                                <?php if (is_array($reading) && !empty($reading['topic'])): ?>
                                    <p><?= esc(substr($reading['topic'], 0, 100)) ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No readings available for today.</p>
                        <?php endif; ?>
                    </a>
                </div>
            </div>

        </div>
        <!-- Did you know?? and Updates Section -->
       <div class="row">
            <div class="col-12 col-md-4">
                <!-- Did You Know Section -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/family') ?>" class="box did-you-know">
                        <i class="fas fa-lightbulb fa-3x"></i> <!-- Lightbulb Icon -->
                        <h3>Saint of The Day</h3>
                        <h3><strong><?= $saintoftheday ?></strong></h3>
                        <p><?= esc(substr($saintofthedaydata, 0, 100)) ?></p>

                    </a>
                </div>

            </div>

            
            <div class="col-12 col-md-4">
                <!-- Assets -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/assets_report') ?>" class="box assets">
                        <i class="fas fa-boxes fa-3x"></i> <!-- Assets Icon -->
                        <h3>Assets</h3>
                        <p><strong>Parish Land:</strong> 10 acres</p>
                        <p><strong>Church Building Value:</strong> $500,000</p>
                        <p><strong>Community Vehicles:</strong> 2</p>
                    </a>
                </div>
            </div>



            <div class="col-12 col-md-4">
                <!-- Novena Notifications Section -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/prayers_novena') ?>" class="box novena-notifications">
                        <i class="fas fa-bell fa-3x"></i> <!-- Bell Icon -->
                        <h3>Novena Notifications</h3>
                        <p><strong>Novena Starting Soon:</strong> Novena for Healing begins tomorrow at 6 PM.</p>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Row 2: Reports, Suggestions, and New Boxes -->
        <div class="row">
            <div class="col-12 col-md-4">
                <!-- Reports -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/treasury_report') ?>" class="box reports">
                        <i class="fas fa-chart-line fa-3x"></i> <!-- Reports Icon -->
                        <h3>Reports</h3>
                        <p><strong>Weekly Mass Attendance:</strong> 150</p>
                        <p><strong>Upcoming Events:</strong> Christmas Mass, Easter Vigil</p>
                        <p><strong>Fundraising Goal:</strong> $50,000</p>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <!-- Welfare Box -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/welfare') ?>" class="box welfare">
                        <i class="fas fa-heart fa-3x"></i> <!-- Welfare Icon -->
                        <h3>Welfare</h3>
                        <p><strong>Community Health Fund:</strong> $10,000</p>
                        <p><strong>Recent Donations:</strong> $2,000</p>
                        <p><strong>Support Needed:</strong> Food, Medicine</p>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <!-- Suggestions Box (last box) -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/suggestion') ?>" class="box suggestions">
                        <i class="fas fa-comments fa-3x"></i> <!-- Suggestions Icon -->
                        <h3>Suggestions</h3>
                        <form action="/submit-suggestion" method="post">
                            <input type="email" name="email" placeholder="Enter your email" required class="form-control mb-2" />
                            <textarea name="suggestion" placeholder="Enter your suggestion here..." required class="form-control mb-2"></textarea>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row 3: Calendar, Dashboard Data, and Vertical Boxes -->
        <div class="row">
            <div class="col-12 col-md-4">
                <!-- Calendar of Events -->
                <div class="box-container">
                    <a href="<?= site_url('tabs/events') ?>" class="box calendar">
                        <i class="fas fa-calendar-alt fa-3x"></i> <!-- Calendar Icon -->
                        <h3>Calendar of Events</h3>
                        <p><strong>Christmas Mass:</strong> Dec 25, 2024</p>
                        <p><strong>Easter Vigil:</strong> April 8, 2025</p>
                        <p><strong>Community Outreach:</strong> Jan 15, 2025</p>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <!-- Common Dashboard Data -->
                <div class="box-container">
                    <a href="#" class="box common-dashboard-data">
                        <i class="fas fa-tachometer-alt fa-3x"></i> <!-- Dashboard Icon -->
                        <h3>Common Dashboard Data</h3>
                        <p><strong>Active Members:</strong> 350</p>
                        <p><strong>Upcoming Donations:</strong> $1,000</p>
                        <p><strong>New Registrations:</strong> 15</p>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="box-container">
                    <a href="#" class="box vertical-box">
                        <h3>Religious Content 1</h3>
                        <p>This is some dummy religious content to fill the space.</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Dashboard Footer -->
        <div class="dashboard-footer">
            <p>Musyoki Stephen Muli</p>
        </div>
    </div>

    <!-- Modal for Saint Details -->
    <div id="saintModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Saint Details</h2>
            <p id="saintDetailContent"></p>
        </div>
    </div>
     <!-- Modal JavaScript -->
    <script>
        function viewSaintDetails(saintName) {
            // Set the content of the modal based on the saint name clicked
            document.getElementById('saintDetailContent').innerText = "Detailed information about " + saintName;
            document.getElementById('saintModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('saintModal').style.display = "none";
        }
    </script>
<?= $this->endSection() ?>
