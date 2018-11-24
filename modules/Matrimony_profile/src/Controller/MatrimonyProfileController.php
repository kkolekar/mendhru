<?php

namespace Drupal\Matrimony_profile\Controller;

use Symfony\Component\HttpFoundation\Response;

class MatrimonyProfileController{
    public function profile(){
        $userCurrent = \Drupal::currentUser();
        //$user = \Drupal\user\Entity\User::load($userCurrent->id());
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        $uuid = $user->uuid();

       

    }



      
}