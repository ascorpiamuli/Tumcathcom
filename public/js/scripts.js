document.addEventListener('DOMContentLoaded', function () {
    console.log("Document loaded, starting to load scripts...");
});

// External Libraries
const scripts = [
  "https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js",
  "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js",
  "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js",
  "https://cdn.jsdelivr.net/npm/apexcharts",
  "https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js",
  "https://cdn.jsdelivr.net/npm/sweetalert2@11",
  "https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js",
  "https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js",
  "https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js",
  "https://cdn.jsdelivr.net/npm/chart.js"
];

// Load scripts dynamically
scripts.forEach((src, index) => {
  const script = document.createElement("script");
  script.src = src;
  script.crossOrigin = "anonymous";

  // Add a load event listener for logging
  script.onload = () => {
    console.log(`Script ${index + 1} loaded successfully: ${src}`);
  };

  // Add an error event listener for logging errors without affecting others
  script.onerror = (error) => {
    console.error(`Error loading script ${index + 1}: ${src}`, error);
  };

  // Append script to head
  document.head.appendChild(script);
  console.log(`Loading script ${index + 1}: ${src}`);
});
