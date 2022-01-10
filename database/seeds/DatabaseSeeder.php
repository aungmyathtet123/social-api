<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'HMA',
            'email'=>'hma@gmail.com',
            'password'=>bcrypt('hma123')
        ]);

        App\Feed::create([
            'user_id'=>1,
            'description'=>'hello guy',
            'image'=>'public/images/aa.jpg'
        ]);
        App\Comment::create([
            'user_id'=>1,
            'feed_id'=>1,
            'comment'=>'good job'
        ]);

        App\Like::create([
            'user_id'=>1,
            'feed_id'=>1,
        ]);
    }
}
