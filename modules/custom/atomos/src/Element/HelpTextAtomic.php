<?php

namespace Drupal\atomos\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a render element for displaying the label for a form element.
 *
 * @RenderElement("help_text_atomic")
 */
class HelpTextAtomic extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#pre_render' => [
        [$class, 'preRenderHelpText'],
      ],
      '#theme' => 'help_text_atomic',
    ];
  }

  /**
   * Prepares a #type 'help_text_atomic' render element for help-text-atomic.html.twig.
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #title and #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for help-text-atomic.html.twig.
   */
  public static function preRenderHelpText($element) {
    Element::setAttributes($element, ['id', 'name']);
    static::setAttributes($element, ['help-text-atomic']);
    return $element;
  }

}
