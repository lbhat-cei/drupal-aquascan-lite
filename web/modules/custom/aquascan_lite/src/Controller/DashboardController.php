<?php

namespace Drupal\aquascan_lite\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the AquaScan dashboard page.
 */
class DashboardController extends ControllerBase {

  /**
   * Display a simple dashboard placeholder.
   */
  public function index() {
    $build = [
      '#markup' => $this->t('<h2>AquaScan Lite Dashboard</h2><p>Welcome to the demo water analytics application.</p>'),
    ];
    return $build;
  }

}
