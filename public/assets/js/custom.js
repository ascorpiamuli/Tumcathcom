

// Function to toggle dropdown visibility when clicking on a tab
function toggleDropdown(element) {
    element.classList.toggle('open');

    // Position the dropdown below the parent tab
    const tabRect = element.getBoundingClientRect();
    const dropdownContent = element.querySelector('.dropdown-content');

    dropdownContent.style.top = `${tabRect.bottom - tabRect.top}px`;
    dropdownContent.style.left = '0'; // Aligns dropdown content with the left of the parent tab

    // Close any other open dropdowns
    document.querySelectorAll('.dropdown.open').forEach(dropdown => {
        if (dropdown !== element) {
            dropdown.classList.remove('open');
        }
    });
}

// Close the dropdown if clicked outside of it
window.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown.open').forEach(drop => {
            drop.classList.remove('open');
        });
    }
});

