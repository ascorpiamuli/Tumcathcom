<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0"><?= $pageTitle ?></h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $pageTitle ?></li>
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
          <h3 class="card-title typingEffect">Monthly Reports</h3>
        </div>
        <div class="card-body p-0">
          <div style="overflow-x: auto; max-width: 100%;">
            <table class="table table-striped table-bordered table-sm" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
              <thead>
                <tr>
                  <th style="width: 5%;">#</th>
                  <th>Report ID</th>
                  <th>Report Month</th>
                  <th>Report Date</th>
                  <th>Report Publisher</th>
                  <th>Expenses Incurred</th>
                  <th>Revenues Earned</th>
                  <th style="width:13%">Download (PDF)</th>
                  <th style="width:16%">Comments</th> <!-- Add actions column -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  $renderedReportIds = []; // Array to keep track of rendered report IDs
                  $counter = 1; // Initialize the counter

                  foreach ($allreportsdata as $report): 
                      // Check if the report ID has already been rendered
                      if (in_array($report['report_id'], $renderedReportIds)) {
                          continue; // Skip rendering this row if it has already been rendered
                      }

                      // Add the report ID to the array to mark it as rendered
                      $renderedReportIds[] = $report['report_id'];
                ?>
                    <tr class="align-middle" id="report-row-<?= $report['report_id'] ?>">
                       <td><?= $counter++ ?>.</td> <!-- Use the counter variable -->
                       <td><?= htmlspecialchars($report['report_id']) ?></td>
                        <td><?= htmlspecialchars($report['report_month']) ?></td>
                        <td><?= htmlspecialchars($report['report_date']) ?></td>
                        <td><?= htmlspecialchars($report['report_publisher']) ?></td>
                        <td><?= htmlspecialchars($report['expenses_incurred']) ?></td>
                        <td><?= htmlspecialchars($report['revenues_earned']) ?></td>
                        <td>
                          <div style="white-space: nowrap; display: flex; gap: 5px;">
                            <button class="btn btn-info btn-sm download-btn">Download Report</button>
                          </div>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm add-comment-btn" data-report-id="<?= $report['report_id'] ?>">Add Comment</button>
                        </td>
                    </tr>

                    <!-- Comment form will be dynamically inserted here -->
                    <tr class="comment-row" id="comment-row-<?= $report['report_id'] ?>" style="display: none;">
                      <td colspan="9">
                        <div class="comment-input">
                          <textarea class="form-control" id="comment-text-<?= $report['report_id'] ?>" rows="3" placeholder="Enter your comment"></textarea>
                          <button class="btn btn-success btn-sm mt-2 save-comment-btn" data-report-id="<?= $report['report_id'] ?>">Save Comment</button>

                        </div>
                      </td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <footer class="text-center">
                Report Compiled and Published by <strong> Francis Thuo, Library & Assets Manager.</strong>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!--end::App Main-->
<?= $this->endSection() ?>
<?=$this->section('scripts')?>
<script>
document.querySelector('.app-content').addEventListener('click', function(event) {
    console.log("Click event detected"); // Log click event detection

    // Show or hide comment form
    if (event.target && event.target.classList.contains('add-comment-btn')) {
        var reportId = event.target.getAttribute('data-report-id');
        console.log("Add comment button clicked, report ID: " + reportId); // Log report ID
        showCommentForm(reportId);
        event.stopPropagation(); // Prevent propagation of click event to other elements
    }

    // Save comment (Fixed to listen to the correct event)
    if (event.target && event.target.classList.contains('save-comment-btn')) {
        var reportId = event.target.getAttribute('data-report-id');
        console.log("Save comment button clicked, report ID: " + reportId); // Log report ID
        saveComment(reportId); // Call saveComment correctly
        event.stopPropagation(); // Prevent propagation of click event to other elements
    }
});


function showCommentForm(reportId) {
    console.log("Toggling comment form for report ID: " + reportId); // Log the toggling of the comment form

    var commentRow = document.getElementById('comment-row-' + reportId);

    // Toggle visibility of the comment form
    commentRow.style.display = commentRow.style.display === 'none' ? 'table-row' : 'none';
    console.log("Comment form visibility: " + commentRow.style.display); // Log the current visibility state
}

function saveComment(reportId) {
    console.log("Saving comment for report ID: " + reportId); // Log when saving a comment

    var commentText = document.getElementById('comment-text-' + reportId).value;
    console.log("Entered comment text: " + commentText); // Log the entered comment text

    if (commentText.trim() === "") {
        alert("Please enter a comment.");
        console.log("No comment entered, aborting save.");
        return;
    }

    // Disable the 'Add Comment' button to prevent multiple submissions
    var addCommentButton = document.querySelector('.add-comment-btn[data-report-id="' + reportId + '"]');
    addCommentButton.disabled = true;

    // Hide the comment input form to prevent further commenting
    var commentRow = document.getElementById('comment-row-' + reportId);
    commentRow.style.display = 'none';

    // Make an AJAX request to save the comment
    console.log("Making AJAX request to save the comment...");
    console.log("Sending data:", {
        report_id: reportId,
        comment: commentText
    });

    fetch('http://localhost/tumcathcom/public/index.php/save-comment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            report_id: reportId,
            comment: commentText
        })
    })
    .then(response => {
        console.log("AJAX request completed, response status: " + response.status); // Log response status
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log("Comment saved successfully!"); // Log success
            alert("Comment saved successfully!");
        } else {
            console.log("Failed to save the comment. Response: " + JSON.stringify(data)); // Log failure message
            alert("Comment Already Submitted.Only one Comment Allowed.");
        }
    })
    .catch(error => {
        console.log("Error during AJAX request: " + error); // Log any errors in the request
        alert("Error saving comment.");
        console.error('Error:', error);
    });
}



</script>

<?= $this->endSection() ?>
