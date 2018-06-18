<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
	    //如果用户拥有管理内容权限的话，即可通过验证
        if ($user->can('manage_contents')){
            return true;
        }

	}
}
