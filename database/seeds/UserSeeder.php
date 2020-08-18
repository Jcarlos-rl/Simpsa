<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $user2 = User::create([
            'name' => 'Juan',
            'email' => 'juan@mail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
