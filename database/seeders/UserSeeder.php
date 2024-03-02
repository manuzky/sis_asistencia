<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    public function run(): void
    {
        User::create( [
            'name' => 'Jose Carrasquel',
            'email' => 'josem.zky@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'fecha_ingreso' => now(),
            'estado' => '1',
            'remember_token' => Str::random(10),
        ]);

        User::create( [
            'name' => 'Joseillys Carrasquel',
            'email' => 'joseillyscarrasquel@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'fecha_ingreso' => now(),
            'estado' => '1',
            'remember_token' => Str::random(10),
        ]);
    }
}
