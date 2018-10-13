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

    $form['Name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
    );

    $form['Contact'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Contact'),
    );

    $form['Save'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('Save'),
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

      $name = $form_state->getValue('Name');
      $password = $form_state->getValue('Password');
      $contact = $form_state->getValue('Contact');
      $save = $form_state->getValue('Save');
      $field = array(
          'uid' => 1,
          'name' =>  $name,
         /* 'Password' => $password,
          'Contact' =>  $contact,
    
         'Etat_message'=>  '',
          'Date_contact'=>  '',
          'adresse_IP'=>  '',*/
          
      );
      drupal_set_message( $name);
   db_insert('registration_form')
       ->fields($field)
      ->execute();
    drupal_set_message("succesfully saved");

      
  }

} 