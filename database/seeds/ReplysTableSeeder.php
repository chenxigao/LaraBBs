<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户id数组[1,2,3]
//        $data=[];
        $user_ids = User::all()->pluck('id')->toArray();
//        $users=User::all();
//        foreach($users as $user){
//            return $data[]=['id'=>$user->id,'name'=>$user->name];
//        }
//        dd($data);

//        dd($user_ids);
        //所有话题ID数组
        $topic_ids = Topic::all()->pluck('id')->toArray();

        //获取实例
        $faker = app(Faker\Generator::class);


        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index)
            use ($user_ids, $topic_ids, $faker) {

                //从用户数组中随机获取并赋值
                $reply->user_id = $faker->randomElement($user_ids);

                //从话题数组中随机获取并赋值
                $reply->topic_id = $faker->randomElement($topic_ids);

            });

        Reply::insert($replys->toArray());
       //话题回复列表数量统计
        foreach($topic_ids as $id){
            $replyData=Reply::where('topic_id',$id)->get();
            Topic::where('id',$id)->update(['reply_count' => count($replyData)]);
        }

    }

}

