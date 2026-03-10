# AquaScan Lite

Minimal Drupal 10 demo module that simulates an industrial water analytics application.

## Features

- Admin dashboard at `/admin/aquascan/dashboard`
- CSV upload form at `/admin/aquascan/upload`
- KPI service for calculating intensities:
  - `water_intensity = water / production`
  - `energy_intensity = energy / production`

## Installation

1. Place the `aquascan_lite` folder in `web/modules/custom/`.
2. Enable the module via `drush en aquascan_lite` or the UI.
3. Assign the permission **Access AquaScan dashboard** to appropriate roles.

## Usage

Navigate to the dashboard or upload pages under the admin section. The upload form accepts CSV files and displays a success message on upload. The KPI service can be used programmatically by fetching the `aquascan_lite.kpi_calculator` service from Drupal's container.

## Example

```php
$calculator = \Drupal::service('aquascan_lite.kpi_calculator');
$water_intensity = $calculator->waterIntensity(100, 25);
```
