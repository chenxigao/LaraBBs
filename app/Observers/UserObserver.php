<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UsersRegistered;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function created(User $user)
    {
        $users = User::where('is_admin', 2)->get();
        if (count($users)) {
            foreach ($users as $data){
                $data->registerNotify(new UsersRegistered($user));
            }
        }
    }

    public function saving(User $user)
    {        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)){
            $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }

    }
    

//    public function deleted(User $user)
//    {
////        \DB::table('topics')->where('user_id',$user->id)->delete();
//    }
}