<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4 text-center">
        <h2 class="text-warning"><i class="bi bi-hourglass-split"></i> Pending Approval</h2>
        <p class="mt-3 text-muted">
            Your account is currently under review. Please be Patient.Review takes less than 24 Hours.

        </p>
        <h3>Contact Your Chairperson for Your Departmental ID.</h3>
       </br>
        <h4><strong>Keep it Safe!</strong></h4>

        <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>

</body>
</html>
