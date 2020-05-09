<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Sopingi",
            "email" => "sopingi@udb.ac.id",
            "hak_akses" => "administrator",
            "password" => Hash::make('admin')
        ]);
    }
}
