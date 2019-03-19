<?php

namespace Drupal\atomos\Element;

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
    return [
      '#theme' => 'help_text_atomic',
    ];
  }

}
