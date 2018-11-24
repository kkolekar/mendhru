<?php
  /**
   * @file
   * Contains \Drupal\Professional_detail_Form\Form\Matrimony_profile.
  */
  namespace Drupal\Matrimony_profile\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class Professional_detail_Form extends FormBase {
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
   
      $form['qualification'] = array(
          '#type' => 'select',
          //'#title' => t('Created_By'),
          '#options' => array(
          'AP' => t('highest Qualification'),
          'Graduate' => t('Graduate'),
          'under Graduate' => t('under Graduate'),
          'Diploma' => t('Diploma'),
        )
      );
      
      $form['collage'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('Collage/institution'),
      );
      $form['Education_detail'] = array(
        '#type' => 'textfield',
        '#placeholder' => t(' Education Detail.'),
      );

      $form['Employee_in'] = array(
          '#type' => 'radios',
          '#title' => t('Employee in '),
          '#options' => array(
          'Government' => t('Government'),
          'Private' => t('Private'), 
          'Bussiness' => t('Bussiness'),
          'Defence' => t('Defence'),
          'Self employed' => t('Self employed'),
          'Not Working' => t('Not Working'),
        )
        );
      
      $form['occupation'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('Occupation'),
      );

      $form['occupation_detail'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('Occupation details'),
      );


      $form['income'] = array(
        '#type' => 'textfield',
        '#placeholder' => t(' Anual Income'),
      );

      $form['Submit'] = array(
        '#type' => 'submit',
        '#input'=> 'TRUE',           
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
      $uuid = $user->uuid();
      $qualification = $form_state->getValue('qualification'); 
      $collage = $form_state->getValue('collage');
      $Education_detail=$form_state->getValue('Education_detail');
      $Employee_in = $form_state->getValue('Employee_in');
      $occupation = $form_state->getValue('occupation');
      $occupation_detail = $form_state->getValue('occupation_detail');
      $income=  $form_state ->getValue('income');
   
      

      db_insert('Matri_Memb_Professionaldetail')
      ->fields(array(
      'memberuuid'=>$uuid,
      'qualification' => $qualification,
      'collage' => $collage,
      'Education_detail' => $Education_detail,
      'Employee_in'=> $Employee_in,
      'occupation' => $occupation,
      'occupation_detail' => $occupation_detail,
      'income' => $income,
       ))->execute();
      drupal_set_message("successfully submitted ");  
       
    }
  }