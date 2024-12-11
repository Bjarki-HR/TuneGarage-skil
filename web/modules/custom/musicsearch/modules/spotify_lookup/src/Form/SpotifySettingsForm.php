<?php

namespace Drupal\spotify_lookup\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Spotify API settings.
 */
class SpotifySettingsForm extends ConfigFormBase {

  /** {@inheritdoc} */
  protected function getEditableConfigNames() {
    return ['spotify_lookup.settings'];
  }

  /** {@inheritdoc} */
  public function getFormId() {
    return 'spotify_lookup_settings_form';
  }

  /** {@inheritdoc} */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('spotify_lookup.settings');

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Spotify API Key'),
      '#default_value' => $config->get('api_key'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /** {@inheritdoc} */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('spotify_lookup.settings')
      ->set('api_key', $form_state->getValue('api_key'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
