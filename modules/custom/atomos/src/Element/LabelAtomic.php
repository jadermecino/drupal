<?php

namespace Drupal\atomos\Element;

use Drupal\Core\Render\Element\Label as LabelParent;

/**
 * Provides a render element for displaying the label for a form element.
 *
 * @RenderElement("label_atomic")
 */
class LabelAtomic extends LabelParent {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#theme' => 'form_element_label_atomic',
    ];
  }

}
