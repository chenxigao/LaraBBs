<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\User;
use App\Notifications\TopicReplied;
use App\Notifications\UsersRegistered;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root(){
//        $user = User::find(1);
//        $user->notify(new TopicReplied(Reply::find(1)));
//
//        $user->registerNotify(new UsersRegistered($user));
        return view('pages.root');
    }


    public function permissionDenied(){

        //如果当前用户有权限访问后台，则直接跳转访问
        if (config('administrator.permission')()){

            return redirect(url(config('administrator.uri')),302);
        }

        //否则使用视图
        return view('pages.permission_denied');

    }


}
