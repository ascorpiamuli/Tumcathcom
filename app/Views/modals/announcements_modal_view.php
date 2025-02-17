<!-- Announcement Banner -->
<div id="announcementBanner" class="announcement-banner">
    <span id="closeBanner" class="close">&times;</span>
    <div class="alert-box">
        <span class="alert-icon">🚨</span>
        <h4 class="announcement-title"><?= esc($announcement['title']) ?></h4>
        <h4 class="announcement-admin">From: <?= esc($announcement['full_name']) ?>(<?=esc($announcement['position']) ?>)</h4>
    </div>
    <p class="announcement-message"><?= esc($announcement['announcement']) ?></p>
</div>

<style>
/* Announcement Banner */
#announcementBanner {
    position: fixed;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    width: 500px; /* Default width for desktop */
    background: linear-gradient(45deg, rgba(78, 4, 85, 0.8), rgba(142, 68, 173, 0.8)); /* Transparent purple gradient */
    color: #fff;
    text-align: center;
    padding: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    font-size: 1em;
    display: none; /* Initially hidden */
    border-radius: 15px; /* Rounded corners */
    animation: slideDown 0.5s ease-in-out, popHeart 1.2s infinite alternate;
    z-index: 9999;
}

/* Slide-down animation */
@keyframes slideDown {
    from {
      transform: translateX(-50%) translateY(-100%);
      opacity: 0;
    }
    to {
      transform: translateX(-50%) translateY(0);
      opacity: 1;
    }
}

/* Heartbeat Animation */
@keyframes popHeart {
    from {
      transform: translateX(-50%) scale(1);
    }
    to {
      transform: translateX(-50%) scale(1.1);
    }
}

/* Alert Box */
.alert-box {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column; /* Stacks title and name vertically */
}

/* Alert Icon */
.alert-icon {
    font-size: 1.8em;
    margin-right: 10px;
}

/* Close button */
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #fff;
}

.close:hover {
    color: #ffcccc;
}

/* Title styling */
.announcement-title {
    font-size: 1.3em;
    font-weight: bold;
    margin-bottom: 5px; /* Space below the title */
}

/* Announcement Admin Name */
.announcement-admin {
    font-size: 1.1em;
    font-weight: normal;
    margin-top: 5px;  /* Space below the title */
    color: #fff;      /* Text color */
}

/* Announcement message */
.announcement-message {
    font-size: 1em;
    margin-top: 5px;
}

/* Media Queries for Smaller Screens */
@media (max-width: 768px) {
    #announcementBanner {
        width: 90%; /* Smaller width on mobile */
        top: 5px;   /* Adjust position */
        right: auto;
        right: 1%;  /* Positioned at the top-right on small screens */
        transform: translateX(0); /* No need to center on small screens */
    }
    
    .alert-box {
        flex-direction: row; /* Align icon and text horizontally */
    }

    .alert-icon {
        font-size: 1.5em; /* Smaller icon */
        margin-right: 10px;
    }

    .announcement-title {
        font-size: 1.2em; /* Smaller title */
    }

    .announcement-admin {
        font-size: 1em; /* Smaller admin name */
    }

    .announcement-message {
        font-size: 0.9em; /* Smaller message */
    }
}
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      var closeBanner = document.getElementById('closeBanner');
      var announcementBanner = document.getElementById('announcementBanner');

      // Show the announcement banner with a slide-down effect
      announcementBanner.style.display = 'block';

      // Auto-hide after 10 seconds
      setTimeout(function() {
          announcementBanner.style.display = 'none';
      }, 10000);

      // Close the banner when clicking the close button
      closeBanner.onclick = function() {
          announcementBanner.style.display = 'none';
      };
  });
</script>
