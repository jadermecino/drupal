<?php

namespace Drupal\Tests\git_indicator\Unit;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\git_indicator\GitIndicatorDiscovery;
use Drupal\Tests\git_indicator\Unit\GitIndicatorDiscovery as GitIndicatorDiscoveryFake;
use Drupal\Tests\UnitTestCase;

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
    $initialData = new \stdClass();
    $initialData->data = TRUE;
    $this->cacheDefault->expects($this->any())
      ->method('get')
      ->will($this->returnValue($initialData));

    $inmutableConfig = $this->createMock('Drupal\Core\Config\ImmutableConfig');
    $inmutableConfig->expects($this->any())
      ->method('get')
      ->will($this->returnValue(TRUE));

    $this->configFactory = $this->createMock('Drupal\Core\Config\ConfigFactoryInterface');
    $this->configFactory->expects($this->any())
      ->method('get')
      ->will($this->returnValue($inmutableConfig));

  }

  /**
   * Checks whether it is possible to clone a site from a gitLab repository.
   */
  public function testGetGitConfigTrue() {
    /** @var \Drupal\git_indicator\GitIndicatorDiscovery $gitIndicatorDiscovery */
    $gitIndicatorDiscovery = new GitIndicatorDiscovery($this->cacheDefault, $this->configFactory);
    $this->assertNotNull($gitIndicatorDiscovery->getGitInfo());
  }

  /**
   * Checks whether it is possible to clone a site from a gitLab repository.
   */
  public function testgetGitInfoEmpty() {
    /** @var \Drupal\git_indicator\GitIndicatorDiscovery $gitIndicatorDiscovery */
    $gitIndicatorDiscovery = new GitIndicatorDiscoveryFake($this->cacheDefault, $this->configFactory);
    $this->assertEmpty($gitIndicatorDiscovery->getGitInfo());
  }

}
