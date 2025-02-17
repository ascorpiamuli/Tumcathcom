// Function to initialize chart with data
export function initializeRevenueChart() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Revenue', 'Total Cost', 'Total Profit', 'Transaction Costs'],
            datasets: [{
                label: 'Financial Overview',
                data: [35210.43, 10390.90, 24813.53, 1200],
                backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}
// Function to initialize sales chart
export function initializeSalesChart() {
    var options = {
        chart: { type: 'line', height: 300 },
        series: [
            { name: 'Revenue', data: [35000, 42000, 38000, 45000, 48000] },
            { name: 'Cost', data: [10000, 12000, 11000, 13000, 12500] },
            { name: 'Profit', data: [25000, 30000, 27000, 32000, 35500] }
        ],
        xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'] },
        colors: ['#007bff', '#dc3545', '#28a745']
    };

    new ApexCharts(document.querySelector("#sales-chart"), options).render();
}
// charts.js

// Wait until the page is loaded
document.addEventListener('DOMContentLoaded', function () {

    // Sales Chart
    const sales_chart_options = {
      series: [
        { name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90] },
        { name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40] },
      ],
      chart: { height: 300, type: 'area', toolbar: { show: false } },
      legend: { show: false },
      colors: ['#0d6efd', '#20c997'],
      dataLabels: { enabled: false },
      stroke: { curve: 'smooth' },
      xaxis: {
        type: 'datetime',
        categories: [
          '2023-01-01', '2023-02-01', '2023-03-01',
          '2023-04-01', '2023-05-01', '2023-06-01', '2023-07-01'
        ]
      },
      tooltip: { x: { format: 'MMMM yyyy' } }
    };
    new ApexCharts(document.querySelector('#revenue-chart'), sales_chart_options).render();
  
    // Sparkline Charts
    const createSparkline = (selector, data) => {
      new ApexCharts(document.querySelector(selector), {
        series: [{ data }],
        chart: { type: 'area', height: 50, sparkline: { enabled: true } },
        stroke: { curve: 'straight' },
        fill: { opacity: 0.3 },
        yaxis: { min: 0 },
        colors: ['#DCE6EC']
      }).render();
    };
  
    createSparkline('#sparkline-1', [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);
    createSparkline('#sparkline-2', [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);
    createSparkline('#sparkline-3', [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);
  });
  

  
  