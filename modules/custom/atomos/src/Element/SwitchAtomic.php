<?php

namespace Drupal\atomos\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a render element for displaying the switch for a form element.
 *
 * @RenderElement("switch_atomic")
 */
class SwitchAtomic extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#pre_render' => [
        [$class, 'preRenderSwitch'],
      ],
      '#theme' => 'switch_atomic',
    ];
  }

  /**
   * Prepares a #type 'switch_atomic' render element for switch-atomic.html.twig.
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #message and #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for switch-atomic.html.twig.
   */
  public static function preRenderSwitch($element) {
    Element::setAttributes($element, ['id', 'name']);
    static::setAttributes($element, ['at-button-switch-to-slider']);
    $element['#attached']['library'] = ['atomos/switch'];
    return $element;
  }

}
