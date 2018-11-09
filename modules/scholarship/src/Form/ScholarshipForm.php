<?php
  /**
   * @file
   * Contains \Drupal\scholarshipform\form\scholarshipform.
  */
  namespace Drupal\scholarship\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class ScholarshipForm extends FormBase {
    /**
     * {@inheritdoc}
    */
    public function getFormId() {
    // dpm('check');
      return 'scholarship';
    }
    /**
     * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {
     //$user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id()); 
    //$uuid = $user->uuid();
    // \$connection = \Drupal::database();
    // //$name = $connection->query("SELECT name FROM registration WHERE uuid = :uuid", [':uuid' => $uuid])->fetchField();

   

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#attributes' => array('class' => array('form-control', 'second-class')),
      '#label_attributes' => array('class' => array('schol-inpute-lbl', 'col-md-8')),
    );


    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
    );


  $form['uploaded_file'] = array(
      '#type' => 'file',
      '#title' => t('Upload your file'),
      '#required' => true

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

    $form['Citizenship'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Citizenship')
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email')
    );

     $form['Address'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Address')
    );

      $form['city'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('city')
    );

       $form['zipcode'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('zipcode')
    );   
 

    $form['study_status'] = array(
      '#type' => 'select',
      '#title' => t('Currentstudy_status'),
      '#options' => array(
        'AP' => t('Please Select'),
        'school leaver' => t('school leaver'),
        'current student' => t('current student')       
       
      )
    );
 
      $form['Qualification1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Qualification1')

    );

        $form['Qualification2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Qualification2')
      
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


    $form['marital_status'] = array(
      '#type' => 'select',
      '#title' => t('marital_status'),
      '#options' => array(
        'AP' => t('Please Select'),
        'Married' => t('Married'),
        'Never Married' => t('Never Married')
        
      )
    );

   $form['award'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('list of award')
      
    );  


    $form['Submit'] = array(
      '#type' => 'submit',
      '#input'=> 'TRUE',      
      '#attributes' => array('class' => array('btn btn-success', 'cui-contrast')),
      '#value' => $this->t('submit')
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
    $uploaded_file=$uploaded_file->getValue('uploaded_file');   
    $gender = $form_state->getValue('gender');
    $Citizenship = $form_state->getValue('Citizenship');
    $email = $form_state->getValue('email');
    $Address = $form_state->getValue('Address');
    $city = $form_state->getValue('city');
    $zipcode = $form_state->getValue('zipcode');
    $study_status = $form_state->getValue('study_status');
    $Qualification1 = $form_state->getValue('Qualification1');
    $Qualification2 = $form_state->getValue('Qualification2');
    $religion = $form_state->getValue('religion');
    $marital_status = $form_state->getValue('marital_status');
    $award = $form_state->getValue('award');
    $dob = $form_state->getValue('candidate_dob');    
    $dob = date_create($dob);
    $dob = date_timestamp_get($dob);



      

      db_insert('scholarship')
     ->fields(array(
      'id' =>$user->id, 
      'name' => $name,
      'uploaded_file' => $uploaded_file,
      'gender' => $gender,
      'Citizenship' => $Citizenship,
      'email' => $email,
      'Address' => $Address,
      'city' => $city,
      'zipcode' => $zipcode,
      'study_status' => $study_status,
      'Qualification1' => $Qualification1,
      'Qualification2' => $Qualification2,
      'religion' => $religion,
      'marital_status' => $marital_status,
      'award' => $award ,     
      'member_dob' => $dob
    ))->execute();
    drupal_set_message("successfully submitted "); 
      
  }
}