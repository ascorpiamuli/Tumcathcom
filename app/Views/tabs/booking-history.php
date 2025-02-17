<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0"><?=$pageTitle?></h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$pageTitle?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title typingEffect">Check Your Booking History </h3>
        </div>
        <div class="card-body p-0">
          <div style="overflow-x: auto; max-width: 100%;">
            <table class="table table-striped table-bordered table-sm" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 13%;">Booking ID</th>
                    <th>Assets Booked</th>
                    <th>Location</th>
                    <th>Date Booked</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th style="width: 30%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($allassetsdata)): ?>
                    <tr>
                        <td colspan="8" class="text-center"><strong>Bookings are not available.</strong></td>
                    </tr>
                <?php else: 
                    $renderedBookingIds = []; // Array to keep track of rendered booking IDs
                    $counter = 1; // Initialize the counter

                    foreach ($allassetsdata as $booking): 
                        // Check if the booking ID has already been rendered
                        if (in_array($booking['booking_id'], $renderedBookingIds)) {
                            continue; // Skip rendering this row if it has already been rendered
                        }

                        // Add the booking ID to the array to mark it as rendered
                        $renderedBookingIds[] = $booking['booking_id'];
                    ?>
                    <tr class="align-middle">
                        <td><?= $counter++ ?>.</td> <!-- Use the counter variable -->
                        <td>
                            <span class="booking-id" title="<?= htmlspecialchars($booking['booking_id']) ?>">
                                <?= substr(htmlspecialchars($booking['booking_id']), 0, 10) . (strlen($booking['booking_id']) > 10 ? '...' : '') ?>
                            </span>
                            <i class="bi bi-clipboard" style="cursor: pointer;" onclick="copyBookingID('<?= htmlspecialchars($booking['booking_id']) ?>')"></i>
                        </td>
                        <td><?= htmlspecialchars($booking['assets_count']) ?></td>
                        <td><?= htmlspecialchars($booking['location']) ?></td>
                        <td><?= htmlspecialchars($booking['booking_start_date']) ?></td>
                        <td><?= htmlspecialchars($booking['booking_end_date']) ?></td>
                        <td>
                            <?php
                                $status = strtolower(htmlspecialchars($booking['booking_status']));
                                $badgeClass = 'badge ';
                                switch ($status) {
                                    case 'pending':
                                        $badgeClass .= 'text-bg-warning';
                                        break;
                                    case 'declined':
                                        $badgeClass .= 'text-bg-danger';
                                        break;
                                    case 'approved':
                                        $badgeClass .= 'text-bg-success';
                                        break;
                                    case 'cancelled':
                                        $badgeClass .= 'text-bg-secondary';
                                        break;
                                    default:
                                        $badgeClass .= 'text-bg-info';
                                }
                            ?>
                            <span class="<?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                        </td>
                        <td>
                            <div style="white-space: nowrap; display: flex; gap: 5px;">
                                <button class="btn btn-info btn-sm download-btn" data-id="<?= htmlspecialchars($booking['booking_id']) ?>">Download</button>
                                <button class="btn btn-secondary btn-sm view-assets-btn" data-id="<?= htmlspecialchars($booking['booking_id']) ?>">View Assets</button>
                                <button class="btn btn-danger btn-sm cancel-btn" data-id="<?= htmlspecialchars($booking['booking_id']) ?>">Cancel Booking</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Hidden row for asset details -->
                    <tr class="assets-details" id="assets-details-<?= $booking['booking_id'] ?>" style="display: none;">
                        <td colspan="8">
                            <div>
                                <h5>Assets for Booking ID: <?= htmlspecialchars($booking['booking_id']) ?></h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Asset Name</th>
                                            <th>Asset Type</th>
                                            <th>Asset Quantity</th>
                                            <th>Asset Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; 
                endif; ?>
            </tbody>


            </table>
            <footer class= "float-center text-center">
                Report Compiled and Published by <strong> Francis Thuo, Library & Assets Manager.</strong>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!--end::App Main-->

<script>
    function copyBookingID(bookingId) {
        console.log(`Attempting to copy Booking ID: ${bookingId}`); // Log bookingId
        navigator.clipboard.writeText(bookingId).then(() => {
            alert('Booking ID copied to clipboard!');
            console.log(`Booking ID ${bookingId} copied successfully!`); // Log success
        }).catch(err => {
            console.error('Error copying text: ', err); // Log error if any
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('Document loaded, setting up event listeners...'); // Log when DOM content is loaded
        
        // Handle View Assets button click
        const viewAssetsButtons = document.querySelectorAll('.view-assets-btn');
        console.log(`Found ${viewAssetsButtons.length} View Assets buttons.`); // Log how many buttons are found

        viewAssetsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-id');
                console.log(`View Assets button clicked for Booking ID: ${bookingId}`); // Log which booking ID is clicked
                
                const detailsRow = document.getElementById('assets-details-' + bookingId);
                if (!detailsRow) {
                    console.error(`No details row found for Booking ID: ${bookingId}`); // Log if the details row doesn't exist
                    return;
                }

                // Toggle visibility of asset details row
                if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
                    console.log(`Loading assets for Booking ID: ${bookingId}`); // Log when assets are being fetched

                    // Show loading spinner or message while waiting for assets
                    detailsRow.innerHTML = '<td colspan="8"><p>Loading assets...</p></td>';

                    // Fetch assets using AJAX
                    fetch(`/tumcathcom/public/index.php/getAssets/${bookingId}`)
                        .then(response => {
                            console.log('Response received from server'); // Log response
                            return response.json();
                        })
                        .then(data => {
                            console.log('Data received:', data); // Log the received data
                            if (data.success) {
                                // Replace loading message with actual asset details
                                const assetsTable = `
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Asset Name</th>
                                                <th>Asset Type</th>
                                                <th>Asset Quantity</th>
                                                <th>Asset Condition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.assets.map(asset => `
                                                <tr>
                                                    <td>${asset.name}</td>
                                                    <td>${asset.category}</td>
                                                    <td>${asset.quantity}</td>
                                                    <td>${asset.asset_condition}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                `;
                                detailsRow.innerHTML = `<td colspan="8">${assetsTable}</td>`;
                                console.log(`Assets for Booking ID: ${bookingId} displayed.`); // Log when assets are displayed
                            } else {
                                detailsRow.innerHTML = '<td colspan="8"><p>No assets found for this booking.</p></td>';
                                console.log(`No assets found for Booking ID: ${bookingId}`); // Log when no assets are found
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching assets:', error); // Log any errors during fetch
                            detailsRow.innerHTML = '<td colspan="8"><p>Failed to load assets.</p></td>';
                        });

                    // Show the row
                    detailsRow.style.display = "table-row";
                    console.log(`Asset details row for Booking ID: ${bookingId} is now visible.`); // Log visibility change
                } else {
                    detailsRow.style.display = "none";
                    console.log(`Asset details row for Booking ID: ${bookingId} hidden.`); // Log visibility change
                }
            });
        });
    });
</script>



<?= $this->endSection() ?>
