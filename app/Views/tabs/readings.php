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
            <h3>Today's Readings</h3>
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
                    <p>No readings available for today.</p>
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
        // Ensure jQuery and FullCalendar are loaded before initializing
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: function(start, end, timezone, callback) {
                    var events = [
                        {
                            title: 'Reading for January 1',
                            start: '2024-01-01',
                            description: 'Readings for New Year'
                        },
                        {
                            title: 'Reading for January 6',
                            start: '2024-01-06',
                            description: 'Readings for Epiphany'
                        }
                    ];
                    callback(events);
                },
                dayClick: function(date, jsEvent, view) {
                    var selectedDate = date.format();
                    fetchReadings(selectedDate);
                }
            });
        });

        // Fetch readings for the selected date
        function fetchReadings(date) {
            var readingsData = {
                '2024-01-01': [
                    {
                        topic: 'New Year Reading',
                        paragraphs: ['This is a reading for the New Year...']
                    }
                ],
                '2024-01-06': [
                    {
                        topic: 'Epiphany Reading',
                        paragraphs: ['This is a reading for the Epiphany...']
                    }
                ]
            };

            var readingsContainer = document.getElementById('readings-list');
            readingsContainer.innerHTML = ''; // Clear previous readings

            if (readingsData[date]) {
                readingsData[date].forEach(function(reading) {
                    var readingCard = document.createElement('div');
                    readingCard.classList.add('reading-card');

                    var topic = document.createElement('h4');
                    topic.textContent = reading.topic;
                    readingCard.appendChild(topic);

                    reading.paragraphs.forEach(function(paragraph) {
                        var para = document.createElement('p');
                        para.textContent = paragraph;
                        readingCard.appendChild(para);
                    });

                    readingsContainer.appendChild(readingCard);
                });
            } else {
                readingsContainer.innerHTML = '<p>No readings available for this date.</p>';
            }
        }
        $(document).ready(function() {
            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                // Add the dateClick event to capture the clicked date
                dateClick: function(info) {
                    // Get the clicked date in 'Y-m-d' format
                    var selectedDate = moment(info.date).format('YYYY-MM-DD');
                    
                    // Log the selected date (for debugging purposes)
                    console.log("Selected Date: " + selectedDate);
                    
                    // Update the URL with the selected date
                    var newUrl = window.location.href.split('?')[0] + "?date=" + selectedDate;
                    
                    // Update the browser's address bar without reloading the page
                    window.history.pushState({ path: newUrl }, '', newUrl);
                    
                    // Optionally, you can also reload or fetch the day's readings using AJAX
                    fetchDayReadings(selectedDate);
                }
            });
        });
        function fetchDayReadings(date) {
            // Make an AJAX request to fetch readings for the selected date
            $.ajax({
                url: 'http://localhost/tumCathCom/public/index.php/tabs/readings/',  // Adjust URL to your actual endpoint
                method: 'GET',
                data: { date: date },
                success: function(response) {
                    // Handle the response (e.g., display the readings in the page)
                    console.log('Readings for ' + date + ':', response);
                    // Optionally, you can update the page with the new readings here
                },
                error: function(error) {
                    console.log('Error fetching readings:', error);
                }
            });
        }

    </script>
<?= $this->endSection() ?>
