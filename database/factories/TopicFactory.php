<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {

    $sentence=$faker->sentence();

    //随机获取一个月以内时间
    $updated_at=$faker->dateTimeThisMonth();

    //传参为最大时间不超过，创建时间永远比更改早
    $created_at=$faker->dateTimeThisMonth($updated_at);

    return [
          'title' => $sentence,
        'body' =>$faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
