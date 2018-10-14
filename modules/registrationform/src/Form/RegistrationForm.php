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
      '#title' => $this->t('Full Name'),
    );

    $form['contact'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Number'),
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
    );

    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('Join'),
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
      
      //$save = $form_state->getValue('Save');
      $field = array(
         /* 'uid' => 1,*/
          'name' =>  $name,
          'contact' =>  $contact,
          'password' => $password = md5($password),//$password,
          
    
         /*'Etat_message'=>  '',
          'Date_contact'=>  '',
          'adresse_IP'=>  '',*/
          
      );
      drupal_set_message( $name);
   db_insert('Member')
       ->fields($field)
      ->execute();
    drupal_set_message("Succesfully Joined!");

      
  }

} 