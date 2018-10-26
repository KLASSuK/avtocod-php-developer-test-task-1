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
        DB::table('users')->insert([
            'name' => 'ADMIN',
            'email' => 'admin@admin.ru',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        factory(User::class)->times(\mt_rand(1, 5))->create();
    }
}
