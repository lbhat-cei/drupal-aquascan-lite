<?php

namespace Drupal\aquascan_lite\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\aquascan_lite\Service\MeasurementRepository;
use Drupal\aquascan_lite\Service\KpiCalculator;

class DashboardController extends ControllerBase {

  public function index() {
    $repo = new MeasurementRepository();
    $calculator = new KpiCalculator();

    $records = $repo->fetchAll();
    $kpis = $calculator->calculateTotals($records);

    $labels = [];
    $water = [];
    $energy = [];
    $production = [];

    foreach ($records as $record) {
      $labels[] = $record->measurement_date;
      $water[] = (float) $record->water_usage;
      $energy[] = (float) $record->energy_usage;
      $production[] = (float) $record->production_output;
    }

    $chart_data = [
      'labels' => $labels,
      'water' => $water,
      'energy' => $energy,
      'production' => $production,
    ];

    $build['summary'] = [
      '#type' => 'markup',
      '#markup' =>
        '<h2>AquaScan Dashboard</h2>' .
        '<p><strong>Total Water:</strong> ' . $kpis['water_total'] . '</p>' .
        '<p><strong>Total Energy:</strong> ' . $kpis['energy_total'] . '</p>' .
        '<p><strong>Total Production:</strong> ' . $kpis['production_total'] . '</p>' .
        '<p><strong>Water Intensity:</strong> ' . ($kpis['water_intensity'] ?? 'N/A') . '</p>' .
        '<p><strong>Energy Intensity:</strong> ' . ($kpis['energy_intensity'] ?? 'N/A') . '</p>',
    ];

    $build['chart'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attributes' => [
        'style' => 'max-width: 900px; margin-top: 24px;',
      ],
      'canvas' => [
        '#type' => 'html_tag',
        '#tag' => 'canvas',
        '#attributes' => [
          'id' => 'aquascan-chart',
          'data-chart' => json_encode($chart_data),
        ],
      ],
    ];

    $build['#attached']['library'][] = 'aquascan_lite/dashboard_charts';

    $build['#attached']['html_head'][] = [
      [
        '#tag' => 'script',
        '#attributes' => [
          'src' => 'https://cdn.jsdelivr.net/npm/chart.js',
        ],
      ],
      'aquascan_chartjs_cdn',
    ];

    return $build;
  }

}