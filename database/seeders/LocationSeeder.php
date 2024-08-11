<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('settings.divisions') as $division) {
            $savedDivision = Location::create([
                'value' => $division['value'],
                'label' => $division['label'],
            ]);
            foreach ($division['districts'] as $district) {
                if (isset($district['seed']) && $district['seed']) {
                    $savedDivision->districts()->create([
                        'value' => $district['value'],
                        'label' => $district['label'],
                        'price' => $district['price'],
                    ]);
                }
            }
        }
    }
}
