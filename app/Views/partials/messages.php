<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
    /* Basic styles for flash messages */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        display: none;
        position: fixed;
        top: 20px;
        right: -100%;  /* Initially off-screen to the right */
        width: 80%;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
        transition: right 1s ease, opacity 1s ease;  /* Transition for slide and fade */
        opacity: 0;  /* Initially invisible */
        z-index: 9999;
    }

    .alert .close {
        background: none;
        border: none;
        font-size: 20px;
        color: #000;
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }

    .alert i {
        margin-right: 8px;
        font-size: 18px;
    }

    .alert-danger {
        background-color: rgba(248, 215, 218, 0.9); /* Red with some transparency */
        color: #721c24;
        border-left: 5px solid #f5c6cb;
    }

    .alert-success {
        background-color: rgba(212, 237, 218, 0.9); /* Green with some transparency */
        color: #155724;
        border-left: 5px solid #c3e6cb;
    }

    .alert-info {
        background-color: rgba(209, 236, 241, 0.9); /* Blue with some transparency */
        color: #0c5460;
        border-left: 5px solid #bee5eb;
    }



        /* Icon styles */
        .icon-success {
            color: #28a745;
        }

        .icon-error {
            color: #dc3545;
        }

        .icon-info {
            color: #17a2b8;
        }
    </style>
</head>
<body>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger fade" id="error-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        <i class="fa-solid fa-circle-exclamation icon-error"></i>
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger fade" id="errors-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        <i class="fa-solid fa-circle-exclamation icon-error"></i>
        <ul id="error-list">
            <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo '<li>' . esc($error) . '</li>';
                    }
                }
            ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success fade" id="success-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        <i class="fa-solid fa-circle-check icon-success"></i>
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('info')): ?>
    <div class="alert alert-info fade" id="info-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        <i class="fa-solid fa-circle-info icon-info"></i>
        <?= esc(session()->getFlashdata('info')) ?>
    </div>
<?php endif; ?>

<!-- JavaScript to handle the swipe-in and fade-out -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showMessage = (elementId) => {
            const message = document.getElementById(elementId);
            if (message) {
                message.style.display = 'block';  // Make the message visible
                setTimeout(() => {
                    message.style.right = '20px';  // Move the message from right to the screen
                    message.style.opacity = 1;  // Make it fully opaque
                }, 100); // Delay to trigger transition
            }
        };

        const hideMessage = (elementId, delay = 5000) => {
            setTimeout(() => {
                const message = document.getElementById(elementId);
                if (message) {
                    message.style.right = '-100%';  // Move the message off-screen to the right
                    message.style.opacity = 0;  // Make it invisible
                    setTimeout(() => {
                        message.style.display = 'none';  // Hide the message after fade-out
                    }, 1000); // Wait for fade-out to complete before hiding (longer for smoother transition)
                }
            }, delay); // Delay before hiding the message (default 5 seconds)
        };

        const closeMessage = (event) => {
            const message = event.target.closest('.alert');
            if (message) {
                message.style.right = '-100%';  // Move the message off-screen to the right
                message.style.opacity = 0;  // Fade it out
                setTimeout(() => {
                    message.style.display = 'none';  // Hide the message after fade-out
                }, 1000); // Wait for fade-out to complete before hiding
            }
        };

        document.querySelectorAll('.close').forEach(button => {
            button.addEventListener('click', closeMessage);
        });

        // Show the messages if they exist
        if (document.getElementById('error-message')) {
            showMessage('error-message');
            hideMessage('error-message');
        }

        if (document.getElementById('errors-message')) {
            showMessage('errors-message');
            hideMessage('errors-message');
        }

        if (document.getElementById('success-message')) {
            showMessage('success-message');
            hideMessage('success-message');
        }

        if (document.getElementById('info-message')) {
            showMessage('info-message');
            hideMessage('info-message');
        }
    });
</script>


</body>
</html>
