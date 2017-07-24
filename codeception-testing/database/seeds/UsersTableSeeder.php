<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->email = 'joe@example.com';
        $user->password = Hash::make('1234');
        $user->save();
    }
}
