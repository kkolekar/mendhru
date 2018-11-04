<?php
  /**
   * @file
   * Contains \Drupal\contactform\form\contactform.
  */
  namespace Drupal\contactform\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class ContactForm extends FormBase {
    /**
     * {@inheritdoc}
    */
    public function getFormId() {
    // dpm('check');
      return 'contact_Form';
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
      '#title' => $this->t('mobile number'),
    );

    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('message'),
    );

    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('send'),
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
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $id = $user->id();    
    $name = $form_state->getValue('name');
    $contact = $form_state->getValue('contact');
    $message= $form_state->getValue('message');
    


    db_insert('contact')
     ->fields(array(
      'id' => $user->id,
      'name' =>  $name,
      'contact' =>  $contact, 
      'message' =>  $message   
    ))->execute();
    drupal_set_message(" Mesaage send successfully"); 
      
  }
} 