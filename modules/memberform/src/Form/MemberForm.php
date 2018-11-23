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
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id()); 
    $uuid = $user->uuid();
    $connection = \Drupal::database();
    $name = $connection->query("SELECT name FROM registration WHERE memberuuid = :memberuuid", [':memberuuid' => $uuid])->fetchField();

    $form['name'] = array(
      '#value' => $name,
      '#type' => 'textfield',
      '#placeholder' => t('Name..'),
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Email..'),
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('password'),
    );

    $form['city'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('City'),
    );

    $form['state'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('State'),
    );

    $form['gender'] = array(
      '#type' => 'select',
      //'#title' => t('Gender'),
      '#options' => array(
        'AP' => t('Gender'),
        'Female' => t('Female'),
        'Male' => t('Male'),
      )
    );

    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
    );

    
    $form['profile_picture'] = array(
      '#type' => 'managed_file',
      '#title' => t(''),
      '#default_value' =>!empty($values['pic']) ? $values['pic'] : '',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
      '#upload_location' => 'public://private',
      '#required' => TRUE,
      '#weight' => -4,
      );

    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',
      '#value' => $this->t('Join'),
      '#attributes' => array('class' => array('submit', 'second-class'))
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
    $uuid = $user->uuid();
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $password = $form_state->getValue('password');
    $city = $form_state->getValue('city');
    $state = $form_state->getValue('state');
    $gender = $form_state->getValue('gender');
    $dob = $form_state->getValue('candidate_dob');
    $dob = date_create($dob);
    $dob = date_timestamp_get($dob);
    $profile_picture=$form_state->getValue('profile_picture');
    $file = \Drupal\file\Entity\File::load( $profile_picture[0] );
    $file=$file->getfilename();
      
    $field = array(
      'name' =>  $name,
      'email' =>  $email,
      'password' => $password = md5($password),
      'city' =>  $city,
      'state' =>  $state,
      'gender' =>  $gender,
      'member_dob' => $dob,
      'member_profile_picture' =>$file
    );      
  
    $query = \Drupal::database()->update('registration');
    $query->fields($field);
    $query->condition('memberuuid',$uuid);
    $query->execute();
    drupal_set_message("Succesfully Joined!");

      
  }
}
