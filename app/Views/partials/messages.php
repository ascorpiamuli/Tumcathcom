<?php
    $successMessage = session()->getFlashdata('success');
    $errorMessage = session()->getFlashdata('error');
    $infoMessage = session()->getFlashdata('info');
    $errorMessages = session()->getFlashdata('errors');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Success Message
        <?php if ($successMessage): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "<?= esc($successMessage) ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        // Error Message
        <?php if ($errorMessage): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "<?= esc($errorMessage) ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        // Multiple Errors
        <?php if (!empty($errorMessages)): ?>
            <?php foreach ($errorMessages as $error => $message): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "<?= esc($message) ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
            <?php endforeach; ?>
        <?php endif; ?>

        // Info Message
        <?php if ($infoMessage): ?>
            Swal.fire({
                icon: 'info',
                title: 'Information!',
                text: "<?= esc($infoMessage) ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
    });
</script>

</body>
</html>
