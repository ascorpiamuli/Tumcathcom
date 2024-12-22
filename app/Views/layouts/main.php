<?= view('partials/messages') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | TUM Catholic Community</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
    <?= $this->renderSection('styles') ?>
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard.css') ?>">
</head>
<body>
    <!-- Top Navigation Bar -->
    <div class="navbar">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="<?= base_url('/assets/images/cathcomlogo.jpg') ?>" alt="St. Francis of Assisi TUM Catholic Community Logo" class="logo">
            <div class="navbar-title">TUMCATHCOM </div>
        </div>
        <!-- Search Bar with Search Icon Inside -->
        <div class="search-container">
            <div class="search-bar-container">
                <input type="text" id="search-input" placeholder="Search..." title="Search" />
                <button class="search-icon" onclick="triggerSearch()" title="Search">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <!-- Icons Section -->
            <div class="icon-container">
                <!-- Notification Icon -->
                <div class="notification-icon">
                    <i class="fas fa-bell" title="Notifications"></i>
                    <div class="notification-dropdown">
                        <a href="#">New Notification 1</a>
                        <a href="#">New Notification 2</a>
                        <a href="#">New Notification 3</a>
                    </div>
                </div>
                <!-- Profile Icon with Dropdown -->
                <div class="dropdown">
                    <i class="fas fa-user" title="Profile"></i>
                    <div class="dropdown-content">
                        <a href="#" onclick="showProfile()">My Profile</a>
                        <a href="#" onclick="showSettings()">Settings</a>
                        <a href="#" onclick="logout()">Logout</a>
                        <a href="#">More</a>
                    </div>
                </div>
                <!-- Logout Icon -->
                <div class="logout-icon" onclick="window.location.href='<?= site_url('auth/logout'); ?>';" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Left Sidebar -->
    <div class="sidebar-left">
        <div class="header-container">
            <div class="dashboard-title">Member Dashboard</div>
        </div>

        <div class="tabs-container">
            <div class="tab active" onclick="window.location.href='<?= site_url('tabs/dashboard'); ?>';">
                <i class="fas fa-home"></i> Dashboard
            </div>
            <div class="tab dropdown" onclick="toggleDropdown(this)">
                <i class="fas fa-users"></i> Family/Jumuia
                <div class="dropdown-content">
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/family'); ?>';">Family Saints</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/semester-registration'); ?>';">Semester Registration</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/prayers_novena'); ?>';">Family Prayers</a>
                </div>
            </div>
            <div class="tab dropdown" onclick="toggleDropdown(this)">
                <i class="fas fa-chart-line"></i> TUMCathCom Reports
                <div class="dropdown-content">
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/assets_report'); ?>';">Assets Booking Report</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/treasury_report'); ?>';">Treasury Reports</a>
                </div>
            </div>
            <div class="tab dropdown" onclick="toggleDropdown(this)">
                <i class="fas fa-praying-hands"></i> Liturgy
                <div class="dropdown-content">
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/daily_prayers/' . $prayer['id']); ?>';">Daily Prayers</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/liturgical_classes'); ?>';">Liturgical Classes</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/choir'); ?>';">Choir</a>
                    <a href="#" onclick="window.location.href='<?= site_url('tabs/readings'); ?>';">Readings</a>
                </div>
            </div>
            <div class="tab active" onclick="window.location.href='<?= site_url('tabs/events'); ?>';">
                <i class="fas fa-calendar-day"></i> Calendar of Events
            </div>
            <div class="tab active" onclick="window.location.href='<?= site_url('tabs/settings'); ?>';">
                <i class="fas fa-cogs"></i> Settings
            </div>

            <div class="tab" onclick="window.location.href='<?= site_url('tabs/help'); ?>';">
                <i class="fas fa-question-circle"></i> Help
            </div>
            <div class="tab" onclick="window.location.href='<?= site_url('tabs/suggestion'); ?>';">
                <i class="fas fa-lightbulb"></i> Suggestion Box
            </div>
            <div class="tab" onclick="window.location.href='<?= site_url('tabs/welfare'); ?>';">
                <i class="fas fa-hands-helping"></i> Welfare
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content">
        <?= $this->renderSection('content') ?> <!-- Ensure content is injected from child view -->
    </div>

    <?=$this->renderSection('scripts')?>

    <!-- Debug Logs (JavaScript) -->
    <script>
        // Log initial page load
        console.log("Dashboard page loaded");

        // Log search input trigger
        function triggerSearch() {
            const searchValue = document.getElementById('search-input').value;
            console.log("Search triggered with value:", searchValue);
        }

        // Log notification icon click
        $(document).on('click', '.notification-icon', function() {
            console.log("Notification icon clicked");
        });

        // Log dropdown toggle click
        function toggleDropdown(element) {
            console.log("Dropdown clicked, toggling visibility.");
            $(element).find(".dropdown-content").toggle();
        }

        // Log profile menu interaction
        function showProfile() {
            console.log("Profile menu item clicked");
        }

        function showSettings() {
            console.log("Settings menu item clicked");
        }

        function logout() {
            console.log("Logout initiated");
        }
    </script>
 <script src="<?= base_url('/assets/js/custom.js'); ?>"></script>
</body>
</html>
