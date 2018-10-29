<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!DB::table('users')->where('name','=','ADMIN')->first())
            DB::table('users')->insert([
                'name' => 'ADMIN',
                'email' => 'admin@admin.ru',
                'password' => bcrypt('password'),
                'is_admin' => true
            ]);
        factory(User::class)->times(mt_rand(7, 14))->create()->each(function ($user){
            factory(Message::class, 5)->create(['user_id'=>$user->id]);
        });
    }
}
