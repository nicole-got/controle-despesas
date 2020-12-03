<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Expense;

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
            'name'      =>  "usuario",
            'email'     =>  "teste123456@gmail.com",
            'password'  =>  "123456",
        ]);
        Expenses::create([
            'user_id'       =>  1,
            'description'   =>  "primeira despesa do mes",
            'date'          =>  "2020-12-02",
            'image'         =>  "image.png",
            'value'         =>  "10",
        ]);
    }
}
