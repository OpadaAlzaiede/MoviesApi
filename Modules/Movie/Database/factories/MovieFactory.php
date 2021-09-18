<?php
namespace Modules\Movie\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Movie\Entities\Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'rate' => $this->faker->numberBetween(1, 10),
            'date' => now(),
            'duration' => $this->faker->numberBetween(100, 300),
            'country' => $this->faker->name,
            'category_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}

