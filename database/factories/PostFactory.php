<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

	$title = $faker->realtext(rand(50,80));
	$created = $faker->dateTimeBetween('-30 days', '-1 days');

    return [
        'title' => $title,
        'author_id' => rand(1,4),
        'created_at' => $created,
        'updated_at' => $created,
        'descr' => $faker->realText(rand(500,800)),
    ];
});
