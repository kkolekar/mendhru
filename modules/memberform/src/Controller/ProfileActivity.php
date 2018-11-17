<?php
  /**
   * @file
   * Contains \Drupal\memberform\form\ProfileActivity.
  */
  namespace Drupal\memberform\Controller;
  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
/**
   * Our simple form class.
  */
  class ProfileActivity {
   
    public function registerProfileActivity() {

      $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id()); 
        $id = $user->id();
        $uuid = $user->uuid();
        $memberid = $_POST['memberid'];
        $type =$_POST['type'];

      db_insert('profilecredit')
      ->fields(array(
        'id' => $user->id,
       'credittype' =>  $type ,
       'memberuuid' => $memberid,
       'viewermemberuuid'=>$uuid
     ))->execute();

     return $memberid;
      }

    }
