<?php
  /**
   * @file
   * Contains \Drupal\Family_Detail_Form\Form\DhangarMatrimony.
  */
  namespace Drupal\Matrimony_profile\Form;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  /**
   * Our simple form class.
  */
  class Family_Detail_Form extends FormBase {
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
  

      $form['family_value'] = array(
          '#type' => 'radios',
          '#title' => t('family type'),
          '#options' => array(
          'Orthodox' => t('Orthodox'),
          'Traditional' => t('Traditional'),
          'Modrate' => t('Modrate'),
          'Liberal'=>t('Liberal')

        
        )
      );
    
      $form['family_type'] = array(
          '#type' => 'radios',
          '#title' => t('family type'),
          '#options' => array(
          'Join' => t('Join'),
          'Nuclear' => t('Nuclea'),
          'Other' => t('Other')
        
        )
      );

      $form['family_status'] = array(
          '#type' => 'radios',
          '#title' => t('family status'),
          '#options' => array(
          'Middle Class' => t('Middle Class'),
          'Upper Middle Class' => t('Upper Middle Class'),
          'Rich' => t('Rich'),
          'Affluent'=>t('Affluent')
        )
      );

      $form['father_occupation'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('father_occupation'),
      );

      $form['mother_occupation'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('Mother_occupation'),
      );

      $form['brother'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('No of Brother'),
      );

     

      $form['marital_status_brother'] = array(
          '#type' => 'select',
          //'#title' => t('marital_status'),
          '#options' => array(
          'AP' => t('brother-married'),
          'Married' => t('Married'),
          'Never Married' => t('Never Married'),
          'Awaiting Divarce' => t('Awaiting Divarce'),
          'Divarce' => t('Divarce'),
          'Widowed' => t('Widowed')
        )
      );
      
      $form['sister'] = array(
        '#type' => 'textfield',
        '#placeholder' => t('No of Sister'),
      );


      $form['marital_status_Sister'] = array(
          '#type' => 'select',
          //'#title' => t('marital_status'),
          '#options' => array(
          'AP' => t('Sister-Married'),
          'Married' => t('Married'),
          'Never Married' => t('Never Married'),
          'Awaiting Divarce' => t('Awaiting Divarce'),
          'Divarce' => t('Divarce'),
          'Widowed' => t('Widowed')
        )
     
      );
    
      $form['about_family'] = array(
        '#type' => 'textarea',
        '#placeholder' => t(' About_family'),
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
      $family_type = $form_state->getValue('family_type'); 
      $father_occupation = $form_state->getValue('father_occupation');
      $mother_occupation = $form_state->getValue('mother_occupation');
      $brother = $form_state->getValue('brother');
      $marital_status_brother = $form_state->getValue('marital_status_brother');
      $sister = $form_state->getValue('sister');
      $marital_status_Sister = $form_state->getValue('marital_status_Sister');
      $about_family = $form_state->getValue('about_family');
      

      db_insert('Matri_Memb_Familydetail')
      ->fields(array(
      'memberuuid' =>$uuid, 
      'father_occupation' => $father_occupation,
      'mother_occupation' => $mother_occupation,
      'brother' => $brother,
      'marital_status_brother'=> $marital_status_brother,
      'sister' => $sister,
      'marital_status_Sister' => $marital_status_Sister,
      'about_family' => $about_family,
       ))->execute();

      drupal_set_message("successfully submitted ");  
       
    }
  }