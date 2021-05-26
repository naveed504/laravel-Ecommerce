<?php

namespace Database\Factories;

use App\Models\QueryBuilderMod;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueryBuiilderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QueryBuilderMod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker-email(),
            'city' => $this->faker-city(),
            'address' => $this->faker-address()

        ];
    }
}
