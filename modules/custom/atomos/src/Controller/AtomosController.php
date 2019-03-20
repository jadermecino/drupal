<?php

namespace Drupal\atomos\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class AtomosController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [];
    $build['container'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Contenedor'),
      '#open' => TRUE,
    ];
    $build['container']['textfield'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nativo'),
      '#default_value' => 'Valor',
      '#size' => 60,
      '#maxlength' => 128,
    ];
    $build['container']['component'] = [
      '#type' => 'textfield_atomic',
      '#title' => $this->t('Atomico'),
      '#default_value' => 'Valor',
      '#size' => 60,
      '#maxlength' => 128,
      '#help_text' => $this->t('Description'),
    ];
    $build['container']['helptext'] = [
      '#type' => 'help_text_atomic',
      '#title' => $this->t('Texto de ayuda'),
    ];
    $build['container']['switch'] = [
      '#type' => 'switch_atomic',
      '#message' => $this->t('Slide.'),
    ];
    return $build;
  }

}
