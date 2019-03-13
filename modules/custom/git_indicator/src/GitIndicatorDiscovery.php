<?php

namespace Drupal\git_indicator;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class GitIndicatorDiscovery.
 */
class GitIndicatorDiscovery implements GitIndicatorDiscoveryInterface {

  /**
   * Drupal\Core\Cache\CacheBackendInterface definition.
   *
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cache;

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Config editable names.
   *
   * @var string
   */
  protected $configString = 'git_indicator.settings';

  /**
   * GitIndicatorDiscovery constructor.
   *
   * @param \Drupal\Core\Cache\CacheBackendInterface $cacheDefault
   *   Backend cache.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   Config factory.
   */
  public function __construct(CacheBackendInterface $cacheDefault, ConfigFactoryInterface $configFactory) {
    $this->cache = $cacheDefault;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public function getGitInfo() {
    $config = $this->configFactory->get($this->configString);
    if (!$config->get('git')) {
      return NULL;
    }
    $release = NULL;
    // Show the git branch, if it exists.
    if ($this->commandExists('git') && $git_describe = $this->executeOsCommand('git describe --all')) {
      // Execute "git describe --all" and get the last part of heads/x.x as
      // tag/branch.
      if (empty($git_describe)) {
        return NULL;
      }
      $git_commit = substr($this->executeOsCommand('git rev-parse HEAD'), 0, 7);
      $tag_branch_parts = explode('/', $git_describe);
      $release = end($tag_branch_parts) . ' [' . $git_commit . ']';
    }
    return trim($release);
  }

  /**
   * Determines if a command exists on the current environment.
   *
   * @param string $command
   *   The command to check.
   *
   * @return bool
   *   TRUE if the command has been found; otherwise, FALSE.
   */
  protected function commandExists($command) {
    if ($obj = $this->cache->get('git_indicator_command_exists:' . $command)) {
      return $obj->data;
    }
    $where_is_command = (PHP_OS == 'WINNT') ? 'where' : 'which';
    $command_return = $this->executeOsCommand("$where_is_command $command");
    $output = !empty($command_return);
    $this->cache->set('git_indicator_command_exists:' . $command, $output);
    return $output;
  }

  /**
   * Execute a system command and return the results.
   *
   * @param string $command
   *   The command to execute.
   *
   * @return string
   *   The results of the string execution.
   */
  protected function executeOsCommand($command) {
    $process = proc_open($command, [
      // STDIN.
      0 => ["pipe", "r"],
      // STDOUT.
      1 => ["pipe", "w"],
      // STDERR.
      2 => ["pipe", "w"],
    ], $pipes);
    if ($process === FALSE) {
      return FALSE;
    }
    $stdout = stream_get_contents($pipes[1]);
    stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($process);

    return $stdout;
  }

}
