<?php

namespace Drupal\git_indicator\Form;

use Drupal\environment_indicator_ui\Form\EnvironmentIndicatorUISettingsForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GitIndicatorCurrentSettingsForm.
 */
class GitIndicatorCurrentSettingsForm extends EnvironmentIndicatorUISettingsForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'git_indicator_current_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $version = \Drupal::state()->get('environment_indicator.current_release', '');
    $form = parent::buildForm($form, $form_state);
    $form['current_release'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Current release'),
      '#description' => $this->t('Enter the current release for this environment.'),
      '#default_value' => $version,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $version = $form_state->getValue('current_release', '');
    \Drupal::state()->set('environment_indicator.current_release', $version);
  }

}
