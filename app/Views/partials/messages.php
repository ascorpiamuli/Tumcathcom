<?php
    $successMessage = session()->getFlashdata('success');
    $errorMessage = session()->getFlashdata('error');
    $infoMessage = session()->getFlashdata('info');
    $errorMessages = session()->getFlashdata('errors')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Modal background overlay */
        .modal {
            display: flex;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Prevent scrolling */
            background-color: rgba(0, 0, 0, 0.3); /* Transparent background */
        }

        /* Hide modal if there is no flash message */
        .hidden {
            display: none !important;
        }

        /* Modal Content */
        .modal-content {
            padding: 20px;
            border-radius: 12px;
            width: 380px;
            text-align: center;
            color: white;
            position: relative;
            backdrop-filter: blur(10px); /* Glass effect */
            opacity: 0.9;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateX(-100vw); /* Start position (off-screen left) */
            animation: slideIn 1.4s ease-out forwards, slideOut 0.5s ease-in 2s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100vw);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(100vw);
            }
        }

        /* Modal color themes */
        .modal-success { background-color: rgba(40, 167, 69, 0.8); }
        .modal-error { background-color: rgba(220, 53, 69, 0.8); }
        .modal-info { background-color: rgba(23, 162, 184, 0.8); }

        /* Icon container */
        .icon-container {
            margin: 15px auto;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Close button */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 22px;
            border: none;
            background: none;
            color: white;
        }

        .close-btn:hover {
            color: #ddd;
        }
    </style>
</head>
<body>

<!-- Show modal only if there is a flash message -->
<?php if ($successMessage || $errorMessage || $infoMessage || $errorMessages): ?>
    <div id="alertModal" class="modal">
        <div id="alertBox" class="modal-content">
            <button class="close-btn" onclick="closeModal()">&times;</button>
            <div id="icon-container" class="icon-container"></div>
            <h2 id="alertTitle"></h2>
            <p id="alertMessage"></p>
        </div>
    </div>
<?php endif; ?>

<!-- JavaScript for Modal -->
<script>
    function showAlert(type, title, message) {
        if (!message || message.trim() === "") return;

        let modal = document.getElementById('alertModal');
        let alertBox = document.getElementById('alertBox');
        let iconContainer = document.getElementById('icon-container');
        let alertTitle = document.getElementById('alertTitle');
        let alertMessage = document.getElementById('alertMessage');

        alertTitle.innerText = title;
        alertMessage.innerText = message;

        let iconHTML = '';

        if (type === "success") {
            alertBox.className = "modal-content modal-success";
            iconHTML = `
                <svg width="80" height="80" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="55" stroke="white" stroke-width="5" fill="none"/>
                    <polyline points="30,60 50,80 90,40" fill="none" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
        } else if (type === "error") {
            alertBox.className = "modal-content modal-error";
            iconHTML = `
                <svg width="80" height="80" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="55" stroke="white" stroke-width="5" fill="none"/>
                    <line x1="40" y1="40" x2="80" y2="80" stroke="white" stroke-width="6" stroke-linecap="round"/>
                    <line x1="80" y1="40" x2="40" y2="80" stroke="white" stroke-width="6" stroke-linecap="round"/>
                </svg>
            `;
        } else if (type === "errors") {
            alertBox.className = "modal-content modal-error";
            iconHTML = `
                <svg width="80" height="80" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="55" stroke="white" stroke-width="5" fill="none"/>
                    <line x1="40" y1="40" x2="80" y2="80" stroke="white" stroke-width="6" stroke-linecap="round"/>
                    <line x1="80" y1="40" x2="40" y2="80" stroke="white" stroke-width="6" stroke-linecap="round"/>
                </svg>
            `;
        } else {
            alertBox.className = "modal-content modal-info";
            iconHTML = '<i class="fa-solid fa-circle-info" style="font-size: 50px;"></i>';
        }

        iconContainer.innerHTML = iconHTML;

        modal.classList.remove("hidden");
        setTimeout(closeModal, 2500);
    }

    function closeModal() {
        let modal = document.getElementById('alertModal');
        if (modal) modal.remove();
    }

    document.addEventListener("DOMContentLoaded", function () {
        <?php if ($successMessage): ?>
            showAlert("success", "Success", "<?= esc($successMessage) ?>");
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            showAlert("error", "Error", "<?= esc($errorMessage) ?>");
        <?php endif; ?>
        <?php if (!empty($errorMessages)): ?>
            <?php foreach ($errorMessages as $error => $message): ?>
                showAlert("error", "Error", "<?= esc($message) ?>");
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($infoMessage): ?>
            showAlert("info", "Information", "<?= esc($infoMessage) ?>");
        <?php endif; ?>
    });
</script>

</body>
</html>
