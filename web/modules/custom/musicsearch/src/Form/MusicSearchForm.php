<?php

namespace Drupal\musicsearch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a music search form.
 */
class MusicSearchForm extends FormBase {

  /** {@inheritdoc} */
  public function getFormId() {
    return 'music_search_form';
  }

  /** {@inheritdoc} */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['q'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
    ];
    return $form;
  }

  /** {@inheritdoc} */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = $form_state->getValue('q');
    $form_state->setRedirect('musicsearch.search', [], ['query' => ['q' => $query]]);
  }

}
