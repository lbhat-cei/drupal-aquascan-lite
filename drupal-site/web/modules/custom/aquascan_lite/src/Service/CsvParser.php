<?php

namespace Drupal\aquascan_lite\Service;

class CsvParser {

  public function parse($filepath) {

    $rows = [];
    if (!file_exists($filepath)) {
      return $rows;
    }

    $handle = fopen($filepath, 'r');

    $header = fgetcsv($handle);

    while (($data = fgetcsv($handle)) !== FALSE) {
      $rows[] = [
        'measurement_date' => $data[0],
        'water_usage' => (float) $data[1],
        'energy_usage' => (float) $data[2],
        'production_output' => (float) $data[3],
      ];
    }

    fclose($handle);

    return $rows;
  }
}