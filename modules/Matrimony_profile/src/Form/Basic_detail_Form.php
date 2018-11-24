<?php
  /**
   * @file
   * Contains \Drupal\dhangarmatrimony\Form\Basic_detail_Form.
  */
  namespace Drupal\Matrimony_profile\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class Basic_detail_Form extends FormBase {
    /**
     * {@inheritdoc}
    */
    public function getFormId() {
    // dpm('check');
      return 'dhangar_matrimony ';
    }
    /**
     * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {
    // $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id()); 
    // $uuid = $user->uuid();
    // $connection = \Drupal::database();
    // $name = $connection->query("SELECT name FROM registration WHERE memberuuid = :memberuuid", [':memberuuid' => $uuid])->fetchField();

    $form['profile'] = array(
      '#type' => 'select',
      //'#title' => t('Created_By'),
      '#options' => array(
        'AP' => t('Profile created for'),
        'Self' => t('Self'),
        'Son' => t('Son'),
        'Daughter' => t('Daughter'),
        'Relative/friend' => t('Relative/friend'),
        'Sister' => t('Sister'),
        'Brother' => t('Brother'),
        'Client-Marriage Bureau' => t('Client-Marriage Bureau')
        
      )
    );
    
    $form['name'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Name..'),
    );
    
    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
    );

    $form['height'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Height'),
    );
    
    $form['weight'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Height'),
    );

    $form['Caste'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Caste'),
    );

    $form['marital_status'] = array(
      '#type' => 'select',
      //'#title' => t('marital_status'),
      '#options' => array(
        'AP' => t('marital_status'),
        'Married' => t('Married'),
        'Never Married' => t('Never Married'),
        'Awaiting Divarce' => t('Awaiting Divarce'),
        'Divarce' => t('Divarce'),
        'Widowed' => t('Widowed')
      )
    );
   

    $form['Body_type'] = array(
      '#type' => 'radios',
      '#title' => t('Body-type'),
      '#options' => array(
        'Slim' => t('Slim'),
        'Athletic' => t('Athletic'), 
        'Average' => t('Average'),
        'Heavy' => t('Heavy'),
      )
      );

      $form['Complexion'] = array(
        '#type' => 'radios',
        '#title' => t('Complexion'),
        '#options' => array(
          'very Fair' => t('very Fair'),
          'Fair' => t('Fair'), 
          'Wheatish' => t('Wheatish'),
          'Dark' => t('Dark'),
        )
        );


        $form['Physical_status'] = array(
          '#type' => 'radios',
          '#title' => t('Physical-status'),
          '#options' => array(
            'Normal' => t('Normal'),
            'Physically Challaged' => t('Physically Challaged'), 
          )
          );

          $form['Mother_tongue'] = array(
            '#type' => 'select',
            //'#title' => t('marital_status'),
            '#options' => array(
              'AP' => t('Mother_tounge'),
              'Marathi' => t('Marathi'),
              'English' => t('English'),
              'Hindi' => t('Hindi'),
            )
          );

          $form['Eating_habits'] = array(
            '#type' => 'radios',
            '#title' => t('Eating-habit'),
            '#options' => array(
              'Vegetarian' => t('Vegetarian'),
              'Non Vegetarian' => t('Non Vegetarian'),
              'Eggetarian' => t('Eggetarian'),  
            )
            );

            $form['Drinking_habits'] = array(
              '#type' => 'radios',
              '#title' => t('Drinking-habits'),
              '#options' => array(
                'No' => t('No'),
                'Drink Socially' => t('Drink Socially'),
                'Yes' => t('Yes'),  
              )
              );

              $form['Smoking_habits'] = array(
                '#type' => 'radios',
                '#title' => t('Smoking-habits'),
                '#options' => array(
                  'No' => t('No'),
                  'Occasionally' => t('Occasionally'),
                  'Yes' => t('Yes'),  
                )
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
    $profile = $form_state->getValue('profile');
    $name = $form_state->getValue('name');
    $dob = $form_state->getValue('candidate_dob');
    $dob = date_create($dob);
    $dob = date_timestamp_get($dob);
    $height = $form_state->getValue('height');
    $weight = $form_state->getValue('weight');
    $Caste = $form_state->getValue('Caste');
    $marital_status = $form_state->getValue('marital_status');
    $Body_type = $form_state->getValue('Body_type');
    $Complexion = $form_state->getValue('Complexion');
    $Physical_status = $form_state->getValue('Physical_status');
    $Mother_tongue = $form_state->getValue('Mother_tongue');
    $Eating_habits = $form_state->getValue('Eating_habits');
    $Drinking_habits = $form_state->getValue('Drinking_habits');
    $Smoking_habits = $form_state->getValue('Smoking_habits');
    
   
  
   db_insert('Matri_Memb_basicdetail')
   ->fields(array(
      'name' =>$name,
      'memberuuid'=>$uuid,
      'profile' =>  $profile,
      'member_dob' => $dob,
      'height' =>  $height,
      'weight' =>  $weight,
      'Caste' => $Caste,
      'marital_status' => $marital_status,
      'Body_type'=> $Body_type,
      'Complexion'=> $Complexion,
      'Physical_status'=> $Physical_status,
      'Mother_tongue'=> $Mother_tongue,
      'Eating_habits'=> $Eating_habits,
      'Drinking_habits'=> $Drinking_habits,
      'Smoking_habits'=> $Smoking_habits

      ))->execute();
  
   
    drupal_set_message("Succesfully Joined!");

      
  }
}
