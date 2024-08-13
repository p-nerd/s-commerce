<?php

namespace Database\Factories;

use App\Enums\OptionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    public function definition()
    {
        $type = $this->faker->randomElement(OptionType::cases());

        return [
            'type' => $type,
            'key' => $this->faker->unique()->word,
            'value' => $this->generateValue($type),
        ];
    }

    private function generateValue(OptionType $dataType)
    {
        return match ($dataType) {
            OptionType::STRING => $this->faker->sentence,
            OptionType::INTEGER => $this->faker->numberBetween(1, 1000),
            OptionType::BOOLEAN => $this->faker->boolean,
            OptionType::ARRAY => json_encode($this->faker->words(3)),
        };
    }
}
