<?php

namespace App\Mailer;

class Mailer
{


    public function sendTo($user, $subject, $view, $data = [])
    {
        \Mail::send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });

//        $vars = json_encode(['to'=>[$user->email],'sub'=>$data]);
//
//        $param = array(
//            'apiUser' => env('SENDCLOUD_API_USER'), # 使用api_user和api_key进行验证
//            'apiKey' => env('SENDCLOUD_API_KEY'),
//            'from' => config('mail')['from']['address'], # 发信人，用正确邮件地址替代
//            'fromName' => config('mail')['from']['name'],
//            'xsmtpapi' => $vars,
//            'templateInvokeName' => $view,
//            'subject' => $subject,
//            'respEmailId' => 'true'
//        );
//
//
//        $sendData = http_build_query($param);
//
//        $options = array(
//            'http' => array(
//                'method' => 'POST',
//                'header' => 'Content-Type: application/x-www-form-urlencoded',
//                'content' => $sendData
//            ));
//        $context  = stream_context_create($options);
//        $result = file_get_contents($vars, FILE_TEXT, $context);
//
//        return $result;
    }


}


