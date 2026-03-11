<?php

namespace Drupal\aquascan_lite\Service;

use Drupal\Core\Database\Database;

class MeasurementRepository {

  public function save(array $row, $source) {

    $connection = Database::getConnection();

    $connection->insert('aquascan_measurements')
      ->fields([
        'measurement_date' => $row['measurement_date'],
        'water_usage' => $row['water_usage'],
        'energy_usage' => $row['energy_usage'],
        'production_output' => $row['production_output'],
        'source_file' => $source,
        'created' => time(),
      ])
      ->execute();
  }

  public function fetchAll() {

    $connection = Database::getConnection();

    return $connection->select('aquascan_measurements', 'm')
      ->fields('m')
      ->execute()
      ->fetchAll();
  }
}