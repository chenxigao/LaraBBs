<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }


    public function saving(Topic $topic)
    {
        //xxs过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        //生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

    }


    public function saved(Topic $topic)
    {

//        dispatch(new TranslateSlug($topic));
        //如slug字段无内容，即使用翻译器对title进行翻译
        if (empty($topic->slug)) {
            dispatch(new TranslateSlug($topic));
            //推送任务到队列
        }


    }

    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }

}