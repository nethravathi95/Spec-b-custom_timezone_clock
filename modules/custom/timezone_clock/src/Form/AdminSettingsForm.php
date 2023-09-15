<?php

namespace Drupal\timezone_clock\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AdminSettingsForm extends ConfigFormBase {

  public function getFormId() {
    return 'timezone_clock_admin_settings_form';
  }

  protected function getEditableConfigNames() {
    return ['timezone_clock.admin_settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('timezone_clock.admin_settings');

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];

    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#options' => [
        'America/Chicago' => 'America/Chicago',
        'America/New_York' => 'America/New_York',
        'Asia/Tokyo' => 'Asia/Tokyo',
        'Asia/Dubai' => 'Asia/Dubai',
        'Asia/Kolkata' => 'Asia/Kolkata',
        'Europe/Amsterdam' => 'Europe/Amsterdam',
        'Europe/Oslo' => 'Europe/Oslo',
        'Europe/London' => 'Europe/London',
      ],
      '#default_value' => $config->get('timezone'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
     // Save the configuration using the Config API.
    //  $config = $this->config('timezone_clock.admin_settings');
    //  $config->set('country', $form_state->getValue('country'));
    //  $config->set('city', $form_state->getValue('city'));
    //  $config->set('timezone', $form_state->getValue('timezone'));
    //  $config->save();
 
    //  // Call the parent submitForm method.
    //  parent::submitForm($form, $form_state);
    $form_state->set('data_key', $value_to_pass);
    
    $config = \Drupal::configFactory()->getEditable('timezone_clock.admin_settings');
    $config->set('country', $form_state->getValue('country'))
         ->set('city', $form_state->getValue('city'))
         ->set('timezone', $form_state->getValue('timezone'))
         ->save();
   }

}
