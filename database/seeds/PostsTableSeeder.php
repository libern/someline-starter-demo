<?php

use Illuminate\Database\Seeder;
use Someline\Models\Foundation\Post;
use Someline\Models\Foundation\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('posts')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $users = User::all();
        /** @var User $user */
        foreach ($users as $user) {
//            // 1st way
//            factory(Post::class, 2)->create()->each(function ($post) use ($user) {
//                $post->user_id = $user->getUserId();
//                $post->save();
//            });
            // 2nd way
            $posts = factory(Post::class, 2)->make();
            $user->posts()->saveMany($posts);
        }
    }
}
