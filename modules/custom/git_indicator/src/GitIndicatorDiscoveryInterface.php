<?php

namespace Drupal\git_indicator;

/**
 * Defines an interface for GitIndicatorDiscovery implementations.
 */
interface GitIndicatorDiscoveryInterface {

  /**
   * Helper function to get the git information.
   *
   * @return string
   *   The git branch or tag.
   */
  public function getGitInfo();

}
