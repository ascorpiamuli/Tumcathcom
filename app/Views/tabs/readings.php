<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<!-- FullCalendar CSS -->
<link href="/public/dist/fullcalendar/main.css" rel="stylesheet">

<style>
    /* Style for the calendar container */
    .calendar-container {
        padding: 20px;
        border-radius: 10px;
        background-color: #003366; /* Deep blue background */
        color: white; /* Default white text */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .calendar-container h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #ffffff; /* White heading text */
        text-align: center;
    }

    #calendar {
        font-family: 'Arial', sans-serif;
    }

    /* Customize FullCalendar text and event colors */
    .fc-daygrid-day-number {
        color: #ffffff; /* White for day numbers */
        font-weight: bold;
    }

    .fc-toolbar-title {
        color: #ffffff; /* White for month/year title */
    }

    .fc-button {
        background-color: #0066cc; /* Brighter blue for buttons */
        color: #ffffff; /* White text for buttons */
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .fc-button:hover {
        background-color: #004d99; /* Darker blue for hover */
    }

    .fc-button:focus {
        outline: none;
    }

    .fc-button-active {
        background-color: #005bb5; /* Active button color */
    }

    .fc-daygrid-event {
        background-color: #ffcc00; /* Gold background for events */
        color: #000000; /* Black text for events */
        border: none;
        border-radius: 3px;
        padding: 2px;
        font-size: 0.85rem;
    }

    .fc-highlight {
        background-color: rgba(255, 255, 255, 0.2); /* Subtle highlight for selected dates */
    }

    /* Make cursor pointer for clickable dates */
    .fc-daygrid-day {
        cursor: pointer;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0"><?= isset($pageTitle) ? $pageTitle : 'TUMCATHCOM'; ?></h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?=site_url('tabs/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= isset($pageTitle) ? $pageTitle : 'TUMCATHCOM'; ?></li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
            <?= view('partials/messages') ?>
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <!-- Start col -->
                <div class="col-lg-7 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-body bg-warning text-black border-white radius-3">
                            <div class="readings-container">
                            <h3 id="reading-heading"><?=$dayscalendar->summary ?? 'No data available'?></h3> 
                                <h4 id="readings-heading">
                                    <?php 
                                        $today = date('Y-m-d');
                                        if (!empty($_GET['date']) && $_GET['date'] === $today) {
                                            echo "Today's Readings";
                                        } else {
                                            $selectedDate = !empty($_GET['date']) ? date('l, F j, Y', strtotime($_GET['date'])) : date('l, F j, Y');
                                            echo $selectedDate;
                                        }
                                    ?>
                                </h4>
                                <div class="readings-list" id="readings-list">
                                    <!-- Dynamic readings will be displayed here -->
                                    <?php if (!empty($readings['content'])): ?>
                                        <?php foreach ($readings['content'] as $reading): ?>
                                            <div class="reading-card">
                                                <h4><?= esc($reading['topic']) ?></h4>
                                                <?php foreach ($reading['paragraphs'] as $paragraph): ?>
                                                    <p><?= esc($paragraph) ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="error-message">
                                            <p>No readings available for <?= esc($selectedDate) ?>.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /.Start col -->
                <!-- Start col -->
                <div class="col-lg-5 connectedSortable">
                    <div class="card text-white bg-primary bg-primary border-primary mb-4">
                        <div class="calendar-container">
                            <h3>Calendar</h3>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <!-- /.Start col -->
            </div>
        </div>
        <!--end::Container-->
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('dist/fullcalendar/dist/index.global.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Initialize FullCalendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today', // Buttons on the left side
                center: 'title', // Title in the center
                right: 'dayGridMonth', // Only month view on the right side
            },
            events: [], // Add your events here

            // Handle date click
            dateClick: function(info) {
                var selectedDate = info.dateStr; // Date in YYYY-MM-DD format
                console.log("Date clicked:", selectedDate); // Log for debugging
                
                // Use the selected date in the URL
                var baseURL = 'http://localhost/tumCathCom/public/index.php/tabs/readings';
                var newURL = `${baseURL}?date=${selectedDate}`;
                
                console.log("Redirecting to:", newURL); // Log for debugging
                
                // Redirect to the URL
                window.location.href = newURL;
            },
        });

        // Render the calendar
        calendar.render();
    });
</script>

<?= $this->endSection() ?>
