<?php

namespace Drupal\atomos\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\Textfield as TextFieldParent;

/**
 * Provides a one-line text field form element.
 *
 * @FormElement("textfield_atomic")
 */
class TextfieldAtomic extends TextFieldParent {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#size' => 60,
      '#maxlength' => 128,
      '#autocomplete_route_name' => FALSE,
      '#process' => [
        [$class, 'processAutocomplete'],
        [$class, 'processAjaxForm'],
        [$class, 'processPattern'],
        [$class, 'processGroup'],
      ],
      '#pre_render' => [
        [$class, 'preRenderTextfield'],
        [$class, 'preRenderGroup'],
      ],
      '#theme' => 'textfield_atomic',
      '#theme_wrappers' => ['form_element_atomic'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function preRenderTextfield($element) {
    $element['#attributes']['type'] = 'text';
    Element::setAttributes($element, ['id', 'name', 'value', 'size', 'maxlength', 'placeholder']);
    static::setAttributes($element, ['textfield-atomic']);
    return $element;
  }

}
