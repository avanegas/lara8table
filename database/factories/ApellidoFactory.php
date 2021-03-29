<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Apellido;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApellidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apellido::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lastname' => $this->faker->lastName,
            'user_id' => function(){
                return User::factory()->create()->id;
            }
        ];
    }
}
