<?php

namespace Drupal\Tests\git_indicator\Unit;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\git_indicator\GitIndicatorDiscovery as GitIndicatorDiscoveryOriginal;

/**
 * Class GitIndicatorDiscovery.
 */
class GitIndicatorDiscovery extends GitIndicatorDiscoveryOriginal {

  /**
   * {@inheritdoc}
   */
  protected function commandExists($command) {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  protected function executeOsCommand($command) {

  }

}
