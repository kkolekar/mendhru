<?php
  /**
   * @file
   * Contains \Drupal\registrationform\form\registrationform.
  */
  namespace Drupal\registrationform\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class RegistrationForm extends FormBase {
    /**
     * {@inheritdoc}
    */
    public function getFormId() {
    // dpm('check');
      return 'registrationform_signupform';
    }
    /**
     * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Full Name'),
    );

    $form['contact'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Mobile Number '),
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('password'),
    );
      
    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('Register'),
    );

    return $form;
  }
  /**
   * {@inheritdoc}
  */

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  
  /**
    * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('name');
    $contact = $form_state->getValue('contact');
    $password = $form_state->getValue('password');
    $entity_storage =  \Drupal::service('entity.manager')->getStorage('user');
    $account_search =$entity_storage->loadByProperties(array('name' => $contact));
    $account = reset($account_search);

    // Create an user if not found.
    if (empty($account)) {
      // Get current language.
      $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
      $account = $entity_storage->create(
        array(
          'name' => $contact,
          'mail' => "$contact@mendhru.com",
          'pass' => $password,
          'status' => 1,
          'access' => time(),
          'field_first_name' => $name,
          'field_last_name' => $name,
        )
      );
      $account->addRole('member');
      $account->set("langcode", $language);
      $account->enforceIsNew();
      $account->save();        
    }
    $uuid =  $account->uuid();
    $registration_field = array(
      'memberuuid' => $uuid,
      'name' =>  $name,
      'contact' =>  $contact,  
    );   
    db_insert('registration')
      ->fields($registration_field)
      ->execute();
    drupal_set_message("Succesfully Joined!");
  }
} 