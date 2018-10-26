<?php

use App\Models\User;
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
        if(!DB::table('users')->where('name','=','ADMIN')->first())
            DB::table('users')->insert([
                'name' => 'ADMIN',
                'email' => 'admin@admin.ru',
                'password' => bcrypt('password'),
                'is_admin' => true
            ]);

        DB::table('messages')->truncate();

        $faker = Faker\Factory::create();

        $data = [];
        factory(User::class)->times(mt_rand(7, 14))->create()->each(function ($user)use($faker, &$data){
            $data[] = [
                'user_id' => $user->id,
                'text' => $faker->text
            ];
        });
        DB::table('messages')->insert($data);
    }
}
