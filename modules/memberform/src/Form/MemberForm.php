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
      '#title' => $this->t('Name')
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email')
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password')
    );

    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('City')
    );

    $form['height'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Height')
    );

    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
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
        'Client-Marriage Bureau' => t('Client-Marriage Bureau')
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
      'Widowed' => t('Widowed')
      )
    );

    $form['gender'] = array(
      '#type' => 'select',
      '#title' => t('Gender'),
      '#options' => array(
      'AP' => t('Please Select'),
      'Female' => t('Female'),
      'Male' => t('Male'),
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
      'Bahai' => t('Bahai')
      )
    );

   
     
    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('Join')
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
      $city = $form_state->getValue('city');
      $height = $form_state->getValue('height');
      $profile = $form_state->getValue('profile');
      $marital_status = $form_state->getValue('marital_status');
      $gender = $form_state->getValue('gender');
      $religion = $form_state->getValue('religion');
      $dob = $form_state->getValue('candidate_dob');
      //$dob = strptime($dob, '%Y-%m-%d');
      $dob = date_create($dob);
      $dob = date_timestamp_get($dob);
      //echo $dob;
      //die('here');
     
      $field = array(
         /* 'uid' => 1,*/
          'name' =>  $name,
          'email' =>  $email,
          'password' => $password = md5($password),//$password,
          'city' =>  $city,
          'height' =>  $height,
          'profile' =>  $profile,
          'marital_status' => $marital_status,
          'gender' =>  $gender,
          'religion' => $religion,
          'member_dob' => $dob
          
        
    
         /*'Etat_message'=>  '',
          'Date_contact'=>  '',
          'adresse_IP'=>  '',*/  
      );
      
      db_insert('registration')
          ->fields($field)
          ->execute();
       drupal_set_message("Succesfully Joined!");
  

      
  }

} 