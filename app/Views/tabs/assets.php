<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>
<?=$this->section('styles')?>
<style>
  .hidden {
    display: none;
}

</style>
<?=$this->endSection()?>

<?= $this->section('content') ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Assets Booking(Internal)</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Book Asset</li>
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
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-14">
              <div class="card card-primary bg-white card-outline mb-4">
                <div class="card-header">
                  <h2 class="card-title typingEffect">Assets Booking Information</h2>
                  <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-lte-toggle="card-collapse"
                  >
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                    <i class="bi bi-x-lg"></i>
                  </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul>
                    <li>Only registered and active members of the Community can book assets internally.</li>
                    <li>Members must have no outstanding dues or penalties to be eligible for booking.</li>
                    <li>All bookings must be made through the official platform or designated authority.</li>
                    <li>Bookings should be submitted at least 48 hours before the intended use of the asset.</li>
                    <li>A confirmation of the booking will be communicated after approval by the Library & Assets Manager.</li>
                    <li>Bookings will be approved on a first-come, first-served basis, with priority given to organizational or official events over personal use.</li>
                    <li>Assets must be used responsibly and returned in the same condition as issued. Damages or loss during use must be reported immediately and may incur a penalty.</li>
                    <li>Assets can only be booked for a maximum duration as determined by the asset type. Extensions must be requested in advance and are subject to availability.</li>
                    <li>Bookings will be reviewed and approved by the Assets Manager or designated personnel. The Assets Manager reserves the right to reject any booking request that does not meet the criteria.</li>
                    <li>Any applicable fees for the asset booking must be paid before approval. Payments must be deposited directly to the designated treasury account, with receipts kept for records.</li>
                    <li>Cancellations must be made at least 24 hours before the booking time. Refunds (if applicable) will be processed according to the organization’s refund policy.</li>
                    <li>Members are responsible for maintaining the cleanliness and upkeep of the asset during use. Penalties may apply for returning assets in unsatisfactory conditions.</li>
                    <li>Certain assets may have restricted availability based on their use case (e.g., reserved for special events or maintenance periods). Availability schedules will be updated regularly and communicated to all members.</li>
                    <li>Members found misusing assets or violating booking rules may face disciplinary action, including suspension of booking privileges.</li>
                    <li>All bookings and payments will be recorded by the Assets Coordinator and audited periodically. Members may request a copy of their booking history for reference.</li>
                  </ul>
                </div>


                <!-- ./card-body -->
              </div>
              <!-- /.card -->

              <!-- /.col -->
            </div>
            <!--end::Row-->
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Assets Booking Form(Internal)</div></div>
                  <div id="regitrationContainer"></div>
                  <?= view('partials/messages') ?>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form class="needs-validation" id="assetsForm" autocomplete="off" action="<?= site_url('/tabs/assets') ?>" method="POST" novalidate >
                    <!--begin::Body-->
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Your Name</label>
                          <input
                            type="text"
                            name="booked_by"
                            class="form-control"
                            id="validationCustom01"
                            value="<?=$fullName?>"
                            readonly
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                          <!--begin::Col-->
                          <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Phone</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">+254</span>
                            <input
                              type="number"
                              class="form-control"
                              id="validationCustomUsername"
                              aria-describedby="inputGroupPrepend"
                              placeholder="eg.795751700"
                              name="phone"
                              readonly
                              value="<?=$userauthprofile['phone_number']?>"
                              required
                            />
                            <div class="invalid-feedback">Please input a Phone Number.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">User ID</label>
                          <select class="form-select" name="family" id="validationCustom04" required readonly>
                            <option value="<?=$userprofile['user_id']?>" selected><?=$userprofile['user_id']?></option>
                        </select>
                          <div class="invalid-feedback">Please select a valid ID.</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Booking ID</label>
                          <input
                            type="text"
                            name="booking_id"
                            class="form-control"
                            id="validationCustom01"
                            value="<?=generateBookingId()?>"
                            readonly
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                      <!-- Assets Section -->
                      <div id="assetsContainer" class="mt-12">

                              <!-- Dynamic Asset Input -->
                        <div class="row g-3 asset-row">
                        <div class="row g-2 asset-row align-items-end mb-3">
                        <div class="col-md-2">
                          <label for="validationCustom04" class="form-label">Select Asset </label>
                          <input type="text" id="assetSearch" data-field-name="assetname" class="form-control" placeholder="Search for Assets" autocomplete="off" list="assetsList"/>
                          <datalist id="assetsList">
                              <!-- Dynamically populated with search results -->
                          </datalist>
                          <div class="invalid-feedback">Please choose an asset from the list.</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-2">
                          <label for="validationCustom01" class="form-label">Asset Category</label>
                          <input
                            type="text"
                             data-field-name="category"
                            class="form-control"
                            placeholder="Asset Category"
                            id="assetCategory"
                            readonly
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-2">
                          <label for="validationCustom01" class="form-label">Asset Condition</label>
                          <input
                            type="text"
                            data-field-name="condition"
                            readonly
                            placeholder="Asset Condition"
                            class="form-control"
                            id="assetCondition"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-2">
                          <label for="validationCustom01" class="form-label">Asset Status</label>
                          <input
                            type="text"
                            data-field-name="status"
                            placeholder="Asset Status"
                            readonly
                            class="form-control"
                            id="assetStatus"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-2">
                          <label for="validationCustom01" class="form-label">Qty.Available</label>
                          <input
                            type="number"
                            data-field-name="value"
                            id="assetValue"
                            placeholder="Qty Available"
                            readonly
                            class="form-control"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-1">
                          <label for="validationCustom01" class="form-label"style="text-align:left">Qty</label>
                          <input
                            type="number"
                            id="qtyInput"
                            data-field-name="quantity"
                            placeholder="quantity"
                            class="form-control"
                            value="1"

                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                              <!-- Remove Row Button -->
                            <div class="col-md-1 text-end">
                              <button type="button" id="addAssetButton" class="btn btn-success btn-sm confirmAssetButton">
                                &#10003; <!-- HTML checkmark symbol -->
                              </button>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Location(Where to be used)</label>
                          <input
                            type="text"
                            name="location"
                            placeholder="Location"
                            class="form-control"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                          <!-- Hire Date and Time Input -->
                          <div class="col-md-6">
                            <label for="hireDateTime" class="form-label">Hire Date and Time</label>
                            <input
                              type="datetime-local"
                              name="hireDateTime"
                              id="hireDateTime"
                              class="form-control"
                              readonly
                              required
                            />
                            <div class="valid-feedback">Looks good!</div>
                          </div>

                          <div class="col-md-6">
                            <label for="returnDateTime" class="form-label">Return Date and Time</label>
                            <input
                              type="datetime-local"
                              name="returnDateTime"
                              id="returnDateTime"
                              class="form-control"
                              required
                            />
                            <div class="valid-feedback">Looks good!</div>
                          </div>

                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Add Comments</label>
                          <textarea
                            name="comments"
                            placeholder="Add Comments"
                            class="form-control"
                            required
                          ></textarea>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                      

                        <!--end::Col-->
                        <input type="hidden" id="assetsInput" name="assetsData"> 
                        <!--end::Col-->
                      </div>
                      </div>
                      <!--end::Row-->
                    </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button class="btn btn-primary" id="buttonSubmit" type="submit">Submit Booking</button>
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
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
<?= $this->endSection() ?>
<?=$this->section('scripts')?>
<script>
  // Utility function to create and display status message
  function createStatusMessage(status, targetContainerId, submitButtonId) {
    if (!status) return; // Exit if status is undefined or null

    const statusLower = status.toLowerCase();
    const targetContainer = document.getElementById(targetContainerId);
    if (!targetContainer) {
      console.error(`Target container with ID '${targetContainerId}' not found.`);
      return;
    }

    // Create the status message div
    const statusDiv = document.createElement('div');
    statusDiv.id = 'statusMessage';
    statusDiv.style.padding = '10px';
    statusDiv.style.marginTop = '10px';
    statusDiv.style.borderRadius = '5px';
    statusDiv.style.display = 'flex';
    statusDiv.style.alignItems = 'center';

    const icon = document.createElement('span');
    icon.style.marginRight = '10px';

    const message = document.createElement('span');

    // Configure styles and messages based on status
    switch (statusLower) {
      case 'pending':
        statusDiv.style.backgroundColor = '#e9ecef'; // Light gray
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#495057';
        icon.innerHTML = '&#128214;'; // Book icon 📖
        message.innerHTML = `
          <strong>Check Your Booking History:</strong> For updates on your bookings, please visit the 
          <a href="http://localhost/tumCathCom/public/index.php/tabs/booking-history" style="color: #007bff; text-decoration: underline;">
            Booking History Tab
          </a>.
        `;

        break;

      case 'approved':
        statusDiv.style.backgroundColor = '#e9ecef'; // Light gray
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#495057';
        icon.innerHTML = '&#128214;'; // Book icon 📖
        message.innerHTML = `
          <strong>Check Your Booking History:</strong> For updates on your bookings, please visit the 
          <a href="http://localhost/tumCathCom/public/index.php/tabs/booking-history" style="color: #007bff; text-decoration: underline;">
            Booking History Tab
          </a>.
        `;

        break;

      case 'declined':
        statusDiv.style.backgroundColor = '#e9ecef'; // Light gray
        statusDiv.style.border = '1px solid #ccc';
        statusDiv.style.color = '#495057';
        icon.innerHTML = '&#128214;'; // Book icon 📖
        message.innerHTML = `
          <strong>Check Your Booking History:</strong> For updates on your bookings, please visit the 
          <a href="http://localhost/tumCathCom/public/index.php/tabs/booking-history" style="color: #007bff; text-decoration: underline;">
            Booking History Tab
          </a>.
        `;

        break;

      default:
        console.error(`Unknown status: ${status}`);
        return;
    }

    // Append icon and message to the status div
    statusDiv.appendChild(icon);
    statusDiv.appendChild(message);

    // Append the status div to the target container
    targetContainer.appendChild(statusDiv);

    // Disable the form submission button if necessary
    if (statusLower === 'pending' || statusLower === 'approved') {
      const submitButton = document.getElementById(submitButtonId);
      if (submitButton) {
        submitButton.disabled = false;
      } else {
        console.error(`Submit button with ID '${submitButtonId}' not found.`);
      }
    }
  }

  // Status values from server-side PHP
   const status = "<?php echo isset($assetsdata['booking_status']) ? $assetsdata['booking_status'] : 'null'; ?>";

  // Call the function for each status
  createStatusMessage(status, 'regitrationContainer', 'buttonSubmit');

</script>
<script>
    // Wait until the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        const assetsSearchInput = document.getElementById('assetSearch');
        const assetsList = document.getElementById('assetsList');
        const registerForm = document.getElementById('assetsForm');

        // Store the valid family names for validation
        let validAssets= [];
        // Attach event listener to the familySearch input field
        assetsSearchInput.addEventListener('input', function () {
            const query = this.value.trim(); // Get the input value and trim whitespace

            // Reset datalist options
            assetsList.innerHTML = '';

            if (query.length > 0) {
                console.log('User is typing:', query); // Log the value in real-time

                // Show a loading option in the datalist
                const loadingOption = document.createElement('option');
                loadingOption.value = 'Loading...';
                assetsList.appendChild(loadingOption);
                // Make the API request to get the family names
                fetch(`/tumcathcom/public/index.php/getAssets?query=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        assetsList.innerHTML = ''; // Clear loading option

                        if (data.length === 0) {
                            const noResultOption = document.createElement('option');
                            
                            noResultOption.value = '';
                            noResultOption.textContent = 'No matching results';
                            assetsList.appendChild(noResultOption);
                            
                        } else {
                            validAssets = data.map(item => item.name); // Assuming 'title' is the family name
                            // Populate datalist with results from the API
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.name; // Assuming 'name' is the family name
                                assetsList.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching Assets:', error);
                        const errorOption = document.createElement('option');
                        errorOption.value = '';
                        errorOption.textContent = 'Error fetching data';
                        assetsList.appendChild(errorOption);
                    });
            }
        });

        // Prevent form submission if the selected family is not in the valid list
        assetsForm.addEventListener('submit', function (e) {
            const assetsValue = assetsSearchInput.value.trim();
            if (assetsValue && !validFamilies.includes(assetsValue)) {
                e.preventDefault();
                alert('Please select a valid assets from the dropdown');
            }
        });
    });
    </script>
<script>
  document.getElementById('assetSearch').addEventListener('input', function () {
    const inputValue = this.value;
    const datalistOptions = document.querySelectorAll('#assetsList option');
    let isValid = false;

    // Check if the input value matches any option in the datalist
    datalistOptions.forEach(function(option) {
        if (option.value === inputValue) {
            isValid = true;
        }
    });

    // If not valid, clear the input value
    if (!isValid) {
        this.setCustomValidity('Please choose a valid asset from the list.');
    } else {
        this.setCustomValidity('');
    }
});

// Optional: Restrict manual typing if you want users to only select from the datalist.
document.getElementById('assetSearch').addEventListener('blur', function () {
    const inputValue = this.value;
    const datalistOptions = document.querySelectorAll('#assetsList option');
    let isValid = false;

    // Check if the input value matches any option in the datalist
    datalistOptions.forEach(function(option) {
        if (option.value === inputValue) {
            isValid = true;
        }
    });

    // Clear the input field if it's not valid
    if (!isValid) {
        this.value = '';
    }
});

</script>
<script>
  // Get references to your inputs
const assetsSearchInput = document.getElementById('assetSearch');
const assetsList = document.getElementById('assetsList');
//const descriptionInput = document.getElementById('assetDescription');
const categoryInput = document.getElementById('assetCategory');
const conditionInput = document.getElementById('assetCondition');
const statusInput = document.getElementById('assetStatus');
const valueInput = document.getElementById('assetValue');
const quantityInput=document.getElementById('qtyInput');

// Initialize a variable to store asset data
let currentAssetData = {};

// Attach event listener to the asset search input
assetsSearchInput.addEventListener('input', function () {
    const query = this.value.trim(); // Get the input value and trim whitespace

    // Reset datalist options
    assetsList.innerHTML = '';

    if (query.length > 0) {
        console.log('User is typing:', query); // Log the value in real-time

        // Show a loading option in the datalist
        const loadingOption = document.createElement('option');
        loadingOption.value = 'Loading...';
        assetsList.appendChild(loadingOption);

        // Make the API request to get the assets
        fetch(`/tumcathcom/public/index.php/getAssets?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                assetsList.innerHTML = ''; // Clear loading option

                if (data.length === 0) {
                    const noResultOption = document.createElement('option');
                    noResultOption.value = '';
                    noResultOption.textContent = 'No matching results';
                    assetsList.appendChild(noResultOption);
                } else {
                    // Populate datalist with results from the API
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name;
                        assetsList.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching Assets:', error);
                const errorOption = document.createElement('option');
                errorOption.value = '';
                errorOption.textContent = 'Error fetching data';
                assetsList.appendChild(errorOption);
            });
    }
});
  // Handle selection from the datalist or direct input of asset name
  assetsSearchInput.addEventListener('change', function () {
    const selectedAssetName = this.value.trim();

    if (selectedAssetName) {
        // Make the API request to get the full asset details for the selected name
        fetch(`/tumcathcom/public/index.php/getAssets?query=${encodeURIComponent(selectedAssetName)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const asset = data[0]; // Assume the first result matches

                    // Fill the inputs with the data and make them readonly
                    currentAssetData = asset; // Store the asset data for potential later use
                   // descriptionInput.value = asset.description;
                    categoryInput.value = asset.category;
                    conditionInput.value = asset.asset_condition;
                    statusInput.value = asset.availability_status;
                    valueInput.value = asset.quantity;

                    // Make inputs readonly after selection
                    //descriptionInput.readOnly = true;
                    categoryInput.readOnly = true;
                    //quantityInput.readOnly=true;
                    conditionInput.readOnly = true;
                    statusInput.readOnly = true;
                    valueInput.readOnly = true;
                }
            })
            .catch(error => {
                console.error('Error fetching asset details:', error);
            });
    } else {
        // Set default placeholders if no asset name is provided
        //descriptionInput.placeholder = "Asset description";
        categoryInput.placeholder = "Asset category";
        conditionInput.placeholder = "Asset condition";
        statusInput.placeholder = "Asset status";
        valueInput.placeholder = " Qty Available";
        quantityInput.placeholder="Qty"

        // Clear the inputs if no asset name is inputted
       // descriptionInput.value = "";
        categoryInput.value = "";
        conditionInput.value = "";
        statusInput.value = "";
        valueInput.value = "";
        quantityInput.value="";
    }
  });

  // Enable editing if the user changes the description or any other input
 // descriptionInput.addEventListener('input', function () {
   // if (currentAssetData) {
        // Allow the user to modify the inputs
        //descriptionInput.readOnly = false;
       // categoryInput.readOnly = false;
       // conditionInput.readOnly = false;
        //statusInput.readOnly = false;
        //valueInput.readOnly = false;
  //  }
//});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const hireDateTimeInput = document.getElementById("hireDateTime");

  function updateKenyanTime() {
    const currentDate = new Date();

    // Adjust the time to Kenyan time (UTC+3)
    const kenyanTimeOffset = 3 * 60 * 60 * 1000; // 3 hours in milliseconds
    const kenyanDate = new Date(currentDate.getTime() + kenyanTimeOffset);

    // Format Kenyan time as 'YYYY-MM-DDTHH:mm'
    const formattedKenyanDateTime = kenyanDate.toISOString().slice(0, 16);

    // Update the input value
    hireDateTimeInput.value = formattedKenyanDateTime;
  }

  // Update the input immediately
  updateKenyanTime();

  // Set an interval to update the input every minute
  setInterval(updateKenyanTime, 20000);
});


</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const assetsContainer = document.getElementById("assetsContainer");
    let assetsData = []; // Centralized array to store all asset data

    // Function to update the centralized array
    const updateAssetsData = () => {
      assetsData = Array.from(assetsContainer.querySelectorAll(".asset-row"))
        .map(row => Array.from(row.querySelectorAll("input")).reduce((obj, input) => {
          const fieldName = input.getAttribute("data-field-name");
          obj[fieldName] = input.value;
          return obj;
        }, {}));
      console.log("Updated assets data array:", assetsData);
    };

    // Function to create a new row with filled data
    const createNewRowWithData = (data) => {
      const newRow = document.createElement("div");
      newRow.classList.add("asset-row", "d-flex", "align-items-center", "mb-2");

      // Create inputs with the provided data
      data.forEach(input => {
        const newInput = document.createElement("input");
        newInput.type = "text";
        newInput.classList.add("form-control", "me-2");
        newInput.value = input.value;
        newInput.setAttribute("readonly", "true");
        newInput.setAttribute("data-field-name", input.fieldName);
        newRow.appendChild(newInput);
      });

      // Add a remove button to the new row
      const removeButton = document.createElement("button");
      removeButton.type = "button";
      removeButton.classList.add("btn", "btn-danger", "removeAssetButton");
      removeButton.textContent = "X";
      newRow.appendChild(removeButton);

      // Append the new row to the container
      assetsContainer.appendChild(newRow);

      // Update the centralized array
      updateAssetsData();
    };

    // Event listener for row actions
    assetsContainer.addEventListener("click", (e) => {
      const row = e.target.closest(".asset-row");

      if (e.target.classList.contains("confirmAssetButton")) {
        // Handle tick button click
        const data = Array.from(row.querySelectorAll("input")).map(input => ({
          value: input.value,
          fieldName: input.getAttribute("data-field-name")
        }));

        // Validate if all inputs are filled
        const allFilled = data.every(input => input.value.trim() !== "");
        if (!allFilled) {
          alert("Please fill all fields before confirming.");
          return;
        }

        // Add a new row with filled data
        createNewRowWithData(data);

        // Clear inputs in the initial row
        row.querySelectorAll("input").forEach(input => input.value = "");
        quantityInput.value="1";
      } else if (e.target.classList.contains("removeAssetButton")) {
        // Handle remove button click
        row.remove();

        // Update the centralized array
        updateAssetsData();
      }

      // Hide the remove button in the first (initial) row
      const initialRow = assetsContainer.querySelector(".asset-row");
      const initialRemoveButton = initialRow.querySelector(".removeAssetButton");
      if (initialRemoveButton) {
        initialRemoveButton.style.display = "none";
      }
    });

    // Send the centralized array to the backend
    document.getElementById("buttonSubmit").addEventListener("click", () => {
      // Add the assets data to a hidden input field
      const assetsInput = document.getElementById("assetsInput");
      assetsInput.value = JSON.stringify(assetsData);

      // Log data for debugging
      console.log("Submitting assets data:", assetsData);

      // Submit the form
      document.getElementById("assetsForm").submit();
    });
  });
</script>






<?=$this->endSection()?>