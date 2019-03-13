<?php

namespace Drupal\Tests\git_indicator\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Tests\UnitTestCase;
use Drupal\git_indicator\GitIndicatorDiscovery;

/**
 * @coversDefaultClass \Drupal\git_indicator\GitIndicatorDiscovery
 * @package Drupal\git_indicator\Unit\GitIndicatorDiscoveryTest
 * @group git_indicator
 */
class GitIndicatorDiscoveryTest extends UnitTestCase {

  use \Drupal\Tests\PhpunitCompatibilityTrait;

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Cache\CacheBackendInterface|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $cacheDefault;

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $container = new ContainerBuilder();
    \Drupal::setContainer($container);

    $this->cacheDefault = $this->createMock('Drupal\Core\Cache\CacheBackendInterface');
    $this->configFactory = $this->createMock('Drupal\Core\Config\ConfigFactoryInterface');

    $gitIndicatorDiscovery = new GitIndicatorDiscovery($this->cacheDefault, $this->configFactory);

    $container->set('git_indicator.discovery', $gitIndicatorDiscovery);

  }

  /**
   * Checks if the service is created in the Drupal context.
   */
  public function testGitIndicatorDiscoveryService() {
    $this->assertNotNull(\Drupal::service('git_indicator.discovery'));
  }

  /**
   * Checks whether it is possible to clone a site from a gitLab repository.
   */
  public function testgetGitInfo() {
    /** @var \Drupal\git_indicator\GitIndicatorDiscovery $returnBoolean */
    $returnBoolean = \Drupal::service('git_indicator.discovery')->getGitInfo();
    $this->assertEquals(TRUE, $returnBoolean);
  }

}
