<?php

namespace Drupal\git_indicator\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('environment_indicator.settings')) {
      $route->setDefault('_form', '\Drupal\git_indicator\Form\SelfCareGitIndicatorSettingsForm');
    }
    if ($route = $collection->get('environment_indicator_ui.settings')) {
      $route->setDefault('_form', '\Drupal\git_indicator\Form\GitIndicatorCurrentSettingsForm');
    }
  }

}
