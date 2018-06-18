<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取faker实例
        $faker=app(Faker\Generator::class);

        //头像假数据
        $avatars=[
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        //生成数据集合

        $users=factory(User::class)
                            ->times(10)
                            ->make()
                            ->each(function ($user,$index)
                            use ($faker,$avatars){

                                //从头像数组中随机取出一个并赋值
                                $user->avatar=$faker->randomElement($avatars);
                            });

        //让隐藏字段可见，并转换为数组
        $user_array=$users->makeVisible(['password','remember_token'])->toArray();

        //插入到数据库中
        User::insert($user_array);

        //单独处理第一个用户的数据
        $user=User::find(1);
        $user->name='Summer';
        $user->email='summer@sails.com';
        $user->avatar='https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->assignRole('Founder'); //初始化角色，将一号用户设置为站长
        $user->save();

        //将2号用户指派为管理员权限
       $user=User::find(2);
       $user->assignRole('Maintainer');

     }
}
