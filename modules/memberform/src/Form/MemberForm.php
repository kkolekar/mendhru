<?php
/**
 * @file
 * Contains \Drupal\memberform\form\memberform.
 */
namespace Drupal\memberform\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Our simple form class.
 */
class MemberForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
   // dpm('check');
    return 'member_registrationform';
  }
  /**
   * {@inheritdoc}
   */


  
  
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
    );

    $form['profile'] = array(
      '#type' => 'select',
      '#title' => t('Create Profile for'),
      '#options' => array(
        'AP' => t('Please Select'),
        'Self' => t('Self'),
        'Son' => t('Son'),
        'Daughter' => t('Daughter'),
        'Relative/friend' => t('Relative/friend'),
        'Sister' => t('Sister'),
        'Brother' => t('Brother'),
        'Client-Marriage Bureau' => t('Client-Marriage Bureau'),
     )
    );

    $form['candidate_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Ap'=> t('Please Select'),
        'female' => t('Female'),
        'male' => t('Male'),
        'bysexual' =>t('Bysexual')
     )
    );

    $form['marital_status'] = array(
      '#type' => 'select',
      '#title' => t('marital_status'),
      '#options' => array(
      'AP' => t('Please Select'),
      'Married' => t('Married'),
      'Never Married' => t('Never Married'),
      'Awaiting Divarce' => t('Awaiting Divarce'),
      'Divarce' => t('Divarce'),
      'Widowed' => t('Widowed'),
      )
    );

    $form['religion'] = array(
      '#type' => 'select',
      '#title' => t('Religion'),
      '#options' => array(
      'AZ' => t('Please Select'),
      'Hindu' => t('Hindu'),
      'Muslim' => t('Muslim'),
      'Sikh' => t('Sikh'),
      'Christion' => t('Christion'),
      'Buddhist' => t('Buddhist'),
      'Jain' => t('Jain'),
      'Parsi' => t('Parsi'),
      'Jewish' => t('Jewish'),
      'Bahai' => t('Bahai'),
      )
    );

    $form['candidate_dob '] = array (
      '#type' => 'date',
      '#title' => t('Date Of Birth '),
      '#required' => TRUE,
    );

    $form['city'] = array(
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#size' => 50,
      '#title' => 'City',
      '#required' => TRUE,
      '#placeholder' => t('City'),
   );

   $form['height'] = array(
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#size' => 50,
      '#title' => 'Height',
      '#required' => TRUE,
      '#placeholder' => t('Height'),
   );

    $form['candidate_confirmation'] = array (
      '#type' => 'radios',
      '#title' => ('Are you above 18 years old?'),
      '#options' => array(
        'Yes' =>t('Yes'),
        'No' =>t('No')
      ),
    );


    $form['candidate_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
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
      $email = $form_state->getValue('email');
      $password = $form_state->getValue('password');
      $profile = $form_state->getValue('profile');
      $marital_status = $form_state->getValue('marital_status');
      $religion = $form_state->getValue('religion');
      $candidate_dob = $form_state->getValue('candidate_dob ');
      $candidate_gender = $form_state->getValue('candidate_gender');
      $candidate_confirmation = $form_state->getValue('candidate_confirmation');
      $candidate_copy = $form_state->getValue('candidate_copy');
      $city = $form_state->getValue('city');
      $height = $form_state->getValue('height');
      $save = $form_state->getValue('Save');
      $field = array(
         /* 'uid' => 1,*/
          'name' =>  $name,
          'email' =>  $email,
          'password' => $password = md5($password),//$password,
          'profile' =>  $profile,
          'marital_status' => $marital_status,
          'religion' => $religion,
          'candidate_dob ' => $candidate_dob,
          'candidate_gender' => $candidate_gender,
          'candidate_confirmation' => $candidate_confirmation,
          'candidate_copy' => $candidate_copy,
          'city' => $city,
          'height' => $height
    
         /*'Etat_message'=>  '',
          'Date_contact'=>  '',
          'adresse_IP'=>  '',*/
          
      );
      drupal_set_message( $name);
   db_insert('registration')
       ->fields($field)
      ->execute();
    drupal_set_message("Succesfully Joined!");

      
  }

} 