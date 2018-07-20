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

    public function updating(User $user)
    {
        //
    }
}