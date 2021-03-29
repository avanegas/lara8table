<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Apellido;
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
  		$user = User::factory()->create([
  			'name' => 'Angel Alfredo',
  			'email'=> 'avanepe@hotmail.com',
  			'email_verified_at' => now(),
  			'password'=> '$2y$10$dbymzN9zuLXmIY5f/c5NzuWIHDv//EcVU/AeqaexOHuY6uJeduNx2',
  			'remember_token' => Str::random(10),
    	]);

  		Apellido::factory()->create([
  			'user_id' => $user->id,
  			'lastname'=> 'Vanegas',
  		]);
      Apellido::factory(99)->create();
    }
}
