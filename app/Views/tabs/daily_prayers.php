<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* Prayer Content Styling */
    .prayer-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #f9f7f4;
        border: 1px solid #e3e1dc;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Georgia', serif;
        text-align: center;
    }

    .prayer-icon {
        font-size: 3rem;
        color: #5a4f4a;
        margin-bottom: 15px;
    }

    .prayer-title {
        font-size: 2rem;
        font-weight: bold;
        color: #5a4f4a;
        margin-bottom: 20px;
        text-transform: capitalize;
    }

    .prayer-content {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #333;
        text-align: justify;
        white-space: pre-line;
    }

    /* Decorative */
    .decorative-bar {
        width: 60%;
        height: 5px;
        margin: 0 auto 20px;
        background: linear-gradient(to right, #8e9eab, #eef2f3);
        border-radius: 50px;
    }

    .amen {
        font-size: 1.5rem;
        font-style: italic;
        text-align: center;
        margin-top: 20px;
        color: #5a4f4a;
    }

    /* Add Fade-In Animation */
    .prayer-container.fade-in {
        animation: fadeIn 1.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Content -->
<div class="prayer-container" id="prayerContainer">
    <!-- Prayer Icon -->
    <div class="prayer-icon">
        <i class="fas fa-praying-hands"></i> <!-- Font Awesome Icon -->
    </div>

    <h1 class="prayer-title"><?= esc($prayer['title']) ?></h1>
    <div class="decorative-bar"></div>
    <p class="prayer-content"><?= nl2br(esc($prayer['content'])) ?></p>
    <div class="decorative-bar"></div>
    <p class="amen">Receive God's Blessing.TUMCATHCOM</p>
</div>

<script>
    // Add fade-in animation on page load
    document.addEventListener('DOMContentLoaded', () => {
        const prayerContainer = document.getElementById('prayerContainer');
        prayerContainer.classList.add('fade-in');
    });
</script>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?= $this->endSection() ?>
