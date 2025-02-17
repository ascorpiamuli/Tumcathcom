// Function to send suggestion
export async function sendSuggestion() {
    let messageInput = document.getElementById('suggestionMessage');
    let message = messageInput.value.trim();

    if (!message) {
        console.warn("Message cannot be empty.");
        alert('Input Field cannot be blank');
        return;
    }

    console.log("Sending suggestion:", message);

    try {
        const response = await fetch('/tumcathcom/public/index.php/suggestion/submit', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `message=${encodeURIComponent(message)}`
        });

        const data = await response.json();
        
        if (data.status === 'success') {
            console.log("Suggestion submitted successfully.");
            messageInput.value = '';
            loadSuggestions(); // Reload suggestions
        } else {
            console.error("Failed to submit suggestion:", data.message);
        }
    } catch (error) {
        console.error("Error submitting suggestion:", error);
    }
}

// Function to load suggestions
export async function loadSuggestions() {
    console.log("Loading suggestions...");

    try {
        const response = await fetch('/tumcathcom/public/index.php/suggestion/fetch');
        const suggestions = await response.json();
        
        console.log("Fetched suggestions:", suggestions);

        let chatBox = document.getElementById('suggestionMessages');
        chatBox.innerHTML = '';

        if (suggestions.length === 0) {
            chatBox.innerHTML = "<p class='text-muted text-center'>No suggestions yet.</p>";
            return;
        }

        let sessionUserId = document.getElementById('sessionUserId').value; // Get logged-in user ID
        suggestions.forEach((suggestion, index) => {
            let isMine = suggestion.user_id == sessionUserId; // Check if the message belongs to the logged-in user

            let profileImage = suggestion.profile_image
                ? `<img src="/tumcathcom/public/uploads/profile_images/${suggestion.profile_image}" class="profile-img rounded-circle shadow-sm" width="40" height="40">`
                : '<i class="bi bi-person-circle text-secondary fs-3"></i>';

            let alignmentClass = isMine ? "justify-content-start" : "justify-content-end";
            let bubbleColor = isMine ? "bg-white text-dark border" : "bg-success text-white";
            let textAlign = isMine ? "text-start" : "text-end";
            let displayName = isMine ? "You" : suggestion.full_name;

            let msgElement = document.createElement('div');
            msgElement.className = `d-flex ${alignmentClass} align-items-center mb-3 message-bubble`;
            msgElement.style.opacity = "0";

            msgElement.innerHTML = `
                ${isMine ? `<div class="me-2">${profileImage}</div>` : ""}
                <div class="p-3 rounded-3 shadow-sm ${bubbleColor}" style="max-width: 75%; word-wrap: break-word;">
                    <div class="d-flex ${textAlign}">
                        <strong>${displayName}</strong>
                        <small class="text-muted ms-2">${suggestion.created_at}</small>
                    </div>
                    <p class="m-0">${suggestion.message}</p>
                </div>
                ${!isMine ? `<div class="ms-2">${profileImage}</div>` : ""}
            `;

            chatBox.appendChild(msgElement);

            setTimeout(() => {
                msgElement.style.opacity = "1";
                msgElement.style.transform = "translateY(0)";
            }, index * 100); // Stagger animation
        });

        setTimeout(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }, 300);

        console.log("Suggestions displayed successfully.");
    } catch (error) {
        console.error("Error loading suggestions:", error);
    }
}


// Event listeners for approving, declining, and viewing assets
export async function setupBookingActions() {
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', async function() {
            let bookingId = this.getAttribute('data-id');
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "Approve this Booking? Action Cannot be undone?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/tumcathcom/public/index.php/approveBooking/${bookingId}`, { method: 'POST' });
                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Approved!',
                            text: 'Booking has been approved successfully.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'info',
                            confirmButtonColor: '#17a2b8'
                        });
                    }
                } catch (error) {
                    console.error("Error approving booking:", error);
                }
            }
        });
    });

    document.querySelectorAll('.decline-btn').forEach(button => {
        button.addEventListener('click', async function() {
            let bookingId = this.getAttribute('data-id');
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to decline this booking?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, decline it!'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/tumcathcom/public/index.php/declineBooking/${bookingId}`, { method: 'POST' });
                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Declined!',
                            text: 'Booking has been declined successfully.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'info',
                            confirmButtonColor: '#17a2b8'
                        });
                    }
                } catch (error) {
                    console.error("Error declining booking:", error);
                }
            }
        });
    });

    document.querySelectorAll('.view-assets-btn').forEach(button => {
        button.addEventListener('click', async function() {
            let bookingId = this.getAttribute('data-id');
            let detailsRow = document.getElementById(`assets-details-${bookingId}`);
            let assetsTableBody = detailsRow.querySelector('.assets-table-body');
            let spinner = detailsRow.querySelector('.spinner-border');

            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
                return;
            }

            spinner.style.display = 'inline-block';
            assetsTableBody.innerHTML = '';

            try {
                const response = await fetch(`/tumcathcom/public/index.php/getAssets/${bookingId}`);
                const data = await response.json();

                setTimeout(() => {
                    spinner.style.display = 'none';
                    if (data.success) {
                        let assetsList = data.assets.map(asset => `
                            <tr>
                                <td>${asset.name}</td>
                                <td>${asset.category}</td>
                                <td>${asset.quantity}</td>
                                <td>${asset.asset_condition}</td>
                            </tr>
                        `).join('');
                        assetsTableBody.innerHTML = assetsList;
                    } else {
                        assetsTableBody.innerHTML = '<tr><td colspan="4" class="text-center">No assets found for this booking.</td></tr>';
                    }
                }, 2000); // 2-second delay
            } catch (error) {
                setTimeout(() => {
                    spinner.style.display = 'none';
                    assetsTableBody.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Error loading assets.</td></tr>';
                }, 2000);
                console.error("Error loading assets:", error);
            }
        });
    });
}
