<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Handlers\ImageUploadHandler;
use Auth;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
           'except' => ['show'],
        ]);
    }


    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function edit(User $user){

        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader,User $user){

        $this->authorize('update',$user);
        $data=$request->all();

        if($request->avatar){
            $result = $uploader->save($request->avatar, 'avatars', $user->id,362);
            if ($result){
                $data['avatar']=$result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功!');
    }

    public function confirmEmail($token)
    {
        $user=User::where('activation_token',$token)->firstOrFail();

        $user->activated=true;
        $user->activation_token=null;
        $user->save();

        Auth::login($user);
        session()->flash('success','恭喜你激活成功！');
        return redirect()->route('users.show',[$user]);
        
    }
    

}
