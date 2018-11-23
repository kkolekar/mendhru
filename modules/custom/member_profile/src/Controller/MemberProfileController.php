<?php

namespace Drupal\member_profile\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemberProfileController{
    public function profile(){
        $userCurrent = \Drupal::currentUser();
        //$user = \Drupal\user\Entity\User::load($userCurrent->id());
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        $uuid = $user->uuid();

       $name = $user->getEmail();


       $result = \Drupal::database()->select('registration','n')
       ->fields( 'n',array('memberuuid', 'name', 'contact','city','state','gender','member_dob'))
       ->execute()->fetchAllAssoc('memberuuid');
       //kint($result);


       $rows = array();
       foreach ($result as $row => $content) {
         $rows[] = array(
           'data' => array($content->name, $content->contact,$content->city,$content->state,$content->member_dob));

       }
       $header = array('name', 'contact','city','state','gender','member_dob');
       $output = array(
         '#theme' => 'table',   
         '#header' => $header,
         '#rows' => $rows
       );
       return $output;

    }



      
}