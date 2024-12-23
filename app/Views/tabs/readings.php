<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="main-container">
        <!-- Calendar Section -->
        <div class="calendar-container">
            <h3>Calendar</h3>
            <div id="calendar"></div>
        </div>

        <!-- Readings Section -->
     <div class="readings-container">
            <h3 id="readings-heading">
                <?php 
                    $today = date('Y-m-d');
                    if (!empty($_GET['date']) && $_GET['date'] === $today) {
                        echo "Today's Readings";
                    } else {
                        $selectedDate = !empty($_GET['date']) ? date('l, F j, Y', strtotime($_GET['date'])) : date('l, F j, Y');
                        echo $selectedDate . "";
                    }
                ?>
            </h3>
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
                      <p>No readings available for <?= esc($selected_date) ?>.</p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<!-- Inject page-specific styles into the styles section -->
<?= $this->section('styles') ?>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        .main-container {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 20px auto;
            flex-wrap: wrap;
        }
        .error-message {
            background-color: #f8d7da; /* Light red background */
            color: #721c24; /* Dark red text */
            border: 1px solid #f5c6cb; /* Red border */
            padding: 15px;
            border-radius: 8px;
            font-size: 10px;
            margin: 20px 0; /* Add spacing around the message */
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .error-message p {
            margin: 0; /* Remove default paragraph margin */
            font-weight: bold;
        }



        .calendar-container {
            flex: 1;
            min-width: 310px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
        }

        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        .readings-container {
            flex: 2;
            min-width: 500px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        .readings-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .reading-card {
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 5px solid #283593; /* Accent color */
            transition: transform 0.3s ease-in-out;
            border-radius: 8px;
        }

        .reading-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        h3 {
            color: #283593;
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        h4 {
            font-size: 12px;
            color: #5e35b1; /* Purple shade */
            margin-bottom: 4px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
    </style>
<?= $this->endSection() ?>

<!-- Inject page-specific scripts into the scripts section -->
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
            },
            events: function (start, end, timezone, callback) {
                var events = [
                    {
                        title: 'Reading for January 1',
                        start: '2024-01-01',
                        description: 'Readings for New Year',
                    },
                    {
                        title: 'Reading for January 6',
                        start: '2024-01-06',
                        description: 'Readings for Epiphany',
                    },
                ];
                callback(events);
            },
            dayClick: function (date, jsEvent, view) {
                var selectedDate = date.format(); // Format the date
                // Update the URL and navigate
                window.location.href = 'http://localhost/tumCathCom/public/index.php/tabs/readings?date=' + selectedDate;
            },
        });
    });
</script>
<?= $this->endSection() ?>