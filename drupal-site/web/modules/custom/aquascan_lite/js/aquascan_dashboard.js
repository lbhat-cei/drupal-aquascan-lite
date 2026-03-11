(function (Drupal, once) {
  Drupal.behaviors.aquascanDashboardCharts = {
    attach(context) {
      once('aquascan-chart', '#aquascan-chart', context).forEach(function (canvas) {
        const chartData = JSON.parse(canvas.dataset.chart);

        if (typeof Chart === 'undefined') {
          console.error('Chart.js is not loaded.');
          return;
        }

        new Chart(canvas, {
          type: 'bar',
          data: {
            labels: chartData.labels,
            datasets: [
              {
                label: 'Water Usage',
                data: chartData.water,
              },
              {
                label: 'Energy Usage',
                data: chartData.energy,
              },
              {
                label: 'Production Output',
                data: chartData.production,
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: 'AquaScan Metrics Dashboard'
              }
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      });
    }
  };
})(Drupal, once);