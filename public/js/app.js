import { sendSuggestion, loadSuggestions, setupBookingActions } from './api.js';
import { initializeRevenueChart, initializeSalesChart } from './chart.js';
import { typeTextEffect, animateCount } from './animations.js';

// Initialize functions when DOM is ready
document.addEventListener("DOMContentLoaded", async () => {
    animateCount("saintCount", 700);
    animateCount("membersCount", 400);
    animateCount("prayersCount", 900);
    animateCount("likesCount", 650);

    // Initialize charts
    initializeRevenueChart();
    typeTextEffect();
    initializeSalesChart();

    // Load suggestions asynchronously
    await loadSuggestions();

    // Set up event listeners for actions
    document.getElementById('sendSuggestion').addEventListener('click', sendSuggestion);
    
    setupBookingActions();
});
