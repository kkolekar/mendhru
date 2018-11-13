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
     
     //avoid duplicated entry in data table ..
      $query = \Drupal::database()->select('profilecredit', 'n')
      ->fields('n', array('id'))
      ->condition('memberuuid', $memberid, '=' )
      ->condition('viewermemberuuid', $uuid, '=')
      ->execute();
      $query->allowRowCount = TRUE;
      if ($query->rowCount() > 0) {
       $responce='already liked';
      }else{
        //database Entry for liked..
        db_insert('profilecredit')
        ->fields(array(
          'id' => $user->id,
         'credittype' =>  $type ,
         'memberuuid' => $memberid,
         'viewermemberuuid'=>$uuid
       ))->execute();
       $responce='liked';
      }
      //kint($result);
        return $responce;
      }

    }
