<?php

namespace Drupal\git_indicator\Form;

use Drupal\environment_indicator\Form\EnvironmentIndicatorSettingsForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GitIndicatorSettingsForm.
 */
class GitIndicatorSettingsForm extends EnvironmentIndicatorSettingsForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'git_indicator_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('git_indicator.settings');
    $form = parent::buildForm($form, $form_state);
    $form['git'] = [
      '#type' => 'checkbox',
      '#title' => t('Show git information'),
      '#description' => t('If available, git information will be shown with the environment name.'),
      '#default_value' => $config->get('git') ?: FALSE,
      '#weight' => -1,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['git_indicator.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\Core\Config\ConfigFactory $editableConfig */
    $editableConfig = \Drupal::service('config.factory');
    $config = $editableConfig->getEditable('environment_indicator.settings');
    $properties = ['toolbar_integration', 'favicon'];
    array_walk($properties, function ($property) use ($config, $form_state) {
      $config->set($property, $form_state->getValue($property));
    });
    $config->save();
    $config = $editableConfig->getEditable('git_indicator.settings');
    $config->set('git', $form_state->getValue('git'))
      ->save();
  }

}
