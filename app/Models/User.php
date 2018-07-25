<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;
//use Carbon\Carbon;

class User extends Authenticatable
{
//    protected $dates=['last_actived_at'];
    use Traits\ActiveUserHelper;
    use Traits\LastActivedAtHelper;

    use HasRoles;

    use Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        //如果要通知的人是当前用户就不必通知了
        if ($this->id == Auth::id()){
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function registerNotify($instance)
    {
        $users=User::where('is_admin',2)->get();
        foreach($users as $data) {
            $data->increment('notification_count');
            $data->laravelNotify($instance);
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user){
            $user->activation_token=str_random(30);
        });
    }


    public function topics(){

        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies(){

        return $this->hasMany(Reply::class);
    }


    public function markAsRead(){
        $this->notification_count=0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function setPasswordAttribute($value){
        //长度为60时，默认已加密
        if(strlen($value) != 60){
            //不等于60，做加密处理
             $value=bcrypt($value);
        }

        $this->attributes['password']=$value;
    }

    public function setAvatarAttribute($path){
        //如果不是http子串开头，那就是从后台上传的，需要补全url
        if (! starts_with($path,'http')){
            //拼接完整的url
            $path=config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar']=$path;
    }

}
