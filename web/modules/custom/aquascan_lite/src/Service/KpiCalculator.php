<?php

namespace Drupal\aquascan_lite\Service;

/**
 * Service calculating AquaScan KPIs.
 */
class KpiCalculator {

  /**
   * Calculate water intensity (water / production).
   *
   * @param float $water
   *   Water usage value.
   * @param float $production
   *   Production amount.
   *
   * @return float|null
   *   Intensity or NULL if production is zero.
   */
  public function waterIntensity(float $water, float $production): ?float {
    if ($production == 0.0) {
      return NULL;
    }
    return $water / $production;
  }

  /**
   * Calculate energy intensity (energy / production).
   *
   * @param float $energy
   *   Energy usage value.
   * @param float $production
   *   Production amount.
   *
   * @return float|null
   *   Intensity or NULL if production is zero.
   */
  public function energyIntensity(float $energy, float $production): ?float {
    if ($production == 0.0) {
      return NULL;
    }
    return $energy / $production;
  }

}
