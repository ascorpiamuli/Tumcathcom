

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
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('familySearch').addEventListener('input', function () {
        const query = this.value.trim(); // Get the input value and trim whitespace

        if (query.length > 0) {
            console.log('User is typing:', query); // Log the value in real-time

            fetch(`/getJumuia?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const familyDropdown = document.getElementById('family');
                    familyDropdown.innerHTML = '<option value="" disabled selected>Select your Family/Jumuia</option>'; // Reset dropdown

                    if (data.length === 0) {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No matching results';
                        familyDropdown.appendChild(option);
                    } else {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Assuming 'id' is the unique identifier
                            option.textContent = item.name; // Family name
                            familyDropdown.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching Jumuia:', error));
        } else {
            // Clear dropdown if input is empty
            const familyDropdown = document.getElementById('family');
            familyDropdown.innerHTML = '<option value="" disabled selected>Select your Family/Jumuia</option>';
        }
    });

});



