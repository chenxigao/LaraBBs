<?php

namespace App\Mailer;

class UserMailer extends Mailer
{

    public function weclcome($user)
    {
        $subject = 'Weclcome To Laravist';
        $view = 'emails.weclcome';
//        $data=['%name%'=> [$user->name],'%token%'=>[str_random(30)]];
        $data = ['name' => $user->name, 'token' => $user->activation_token];

        $this->sendTo($user, $subject, $view, $data);

    }


}