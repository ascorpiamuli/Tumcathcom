<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="saint-content">
        <div class="saint-info">
            <h2>Saint Information</h2>

            <?php if (!empty($saintData)): ?>
                <div class="saint-details">
                    <!-- Saint Info Box -->
                    <div class="saint-info-box">
                        <h3 class="prayer-title">
                            <span class="prayer-icon">&#9733;</span> <?= esc($saintData['title']) ?> <span class="prayer-icon">&#9733;</span>
                        </h3>
                        <p><strong>Feast Day:</strong> <?= !empty($saintData['feast_day']) ? esc($saintData['feast_day']) : 'Not Available' ?></p>
                        <p><strong>Patron:</strong> <?= !empty($saintData['patron']) ? esc($saintData['patron']) : 'Not Available' ?></p>
                        <p><strong>Birth:</strong> <?= !empty($saintData['birth']) ? esc($saintData['birth']) : 'Not Available' ?></p>
                        <p><strong>Death:</strong> <?= !empty($saintData['death']) ? esc($saintData['death']) : 'Not Available' ?></p>

                        <!-- YouTube Box -->
                        <div class="youtube-box">
                            <?php if (!empty($saintData['youtube_links'])): ?>
                                <?php
                                    // Clean and extract the valid YouTube link
                                    $youtubeLink = preg_replace('/[^a-zA-Z0-9:\/?&=._-]/', '', $saintData['youtube_links']);
                                    $youtubeLink = preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $youtubeLink, $matches) ? $matches[0] : '';
                                ?>
                                <?php if ($youtubeLink): ?>
                                    <p><strong>Youtube:</strong><a href="<?= esc($youtubeLink) ?>" target="_blank" class="youtube-thumbnail"><?= esc($youtubeLink) ?></a></p>
                                <?php else: ?>
                                    <p>No Video Link available</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>No YouTube link available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-data-box">
                    <p>No data found for this saint.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Saint Paragraphs in a Separate Column -->
        <div class="saint-paragraphs">
            <h3>Saint's Biography</h3>
            <div id="paragraph-container" class="paragraphs-box">
                <!-- Render the paragraphs with <br> tags directly -->
                <p id="paragraph"><?= $saintData['paragraphs'] ?></p>
            </div>
        </div>
    </div>
</div>

<style>
    /* General page styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #333;
    }

    /* Main container */
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .saint-content {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 30px;
    }

    /* Saint Information Box */
    .saint-info {
        flex: 1;
        min-width: 300px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .saint-info h2 {
        color:  #5e35b1; /* Purple */
        font-size: 28px;
        text-align: center;
        margin-bottom: 20px;
    }

    .saint-info-box {
        background-color: #fafafa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .saint-info-box h3 {
        color: #5e35b1; /* Purple */
        font-size: 17px;
        text-align: center;
        margin-bottom: 20px;
    }

    .saint-info-box p {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
        margin-bottom: 10px;
    }

    .saint-info-box strong {
        color: #333;
    }

    /* Saint Paragraph Box */
    .saint-paragraphs {
        flex: 1;
        min-width: 390px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .saint-paragraphs h3 {
        color: #6a4dff; /* Purple */
        font-size: 20px;
        margin-bottom: 20px;
    }

    .paragraphs-box {
        padding: 15px;
        background-color: #f8f9fa;
        border-left: 5px solid #283593; /* Accent color */
        transition: transform 0.3s ease-in-out;
        border-radius: 8px;
        animation: fadeIn 2s forwards;
    }

    .paragraphs-box p {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
        margin-bottom: 10px;
    }

    /* No data box */
    .no-data-box {
        text-align: center;
        background-color: #f9c2c2;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .no-data-box p {
        font-size: 18px;
        color: #9c3c3c;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .saint-content {
            flex-direction: column;
            align-items: center;
        }

        .saint-info,
        .saint-paragraphs {
            width: 100%;
            margin-top: 20px;
        }
    }
</style>
<script>
// Get the content of the paragraph element
var paragraphContent = document.getElementById('paragraph').innerHTML;

// Replace all occurrences of " " with <br> tags
var updatedContent = paragraphContent.replace(/" "/g, '<br>');

// Update the HTML with the new content
document.getElementById('paragraph').innerHTML = updatedContent;
</script>
<?= $this->endSection() ?>
