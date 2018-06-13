<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query,$order){

        switch ($order){
            case 'recent':
                $query->recentReplied();
                break;
            default:
                $query->recent();
                break;

        }
        //预加载防止N+1问题
        return $query->with('user','category');

    }

    public function scopeRecentReplied($query){

        //当有新话题时，我们会编辑逻辑更改话题reply_count属性
        //自动触发框架对updated_at时间戳更新
        return $query->orderBy('updated_at','category');

    }

    public function scopeRecent($query){
        //对创建时间进行排序
        return $query->orderBy('created_at','desc');
    }

   public function link($paramas=[]){

        return route('topics.show',array_merge([$this->id,$this->slug],$paramas));
   }

}
