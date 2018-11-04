<?php

namespace Drupal\member_profile\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemberProfileController{
    public function profile(){
        $userCurrent = \Drupal::currentUser();
        //$user = Drupal\registrationform\Form::load($userCurrent->id());
       // kint($userCurrent);
//        $name = $userCurrent->getEmail();
//        $emailId =
//        $contactNumber=
//        $city=
//        $height=
//        $dateOfBirth=
//        $maritalStatus=
//        $gender=

        return array(
           '#title'=> 'Hello world',
            '#markup'=> $name,
        );
    }
}