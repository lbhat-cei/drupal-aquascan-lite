<?php

namespace Drupal\aquascan_lite\Service;

class KpiCalculator {

  public function calculateTotals(array $records) {

    $water = 0;
    $energy = 0;
    $production = 0;

    foreach ($records as $r) {
      $water += $r->water_usage;
      $energy += $r->energy_usage;
      $production += $r->production_output;
    }

    return [
      'water_total' => $water,
      'energy_total' => $energy,
      'production_total' => $production,
      'water_intensity' => $production ? $water / $production : null,
      'energy_intensity' => $production ? $energy / $production : null,
    ];
  }
}