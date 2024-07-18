<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DIVISIONS = [
            'barisal' => [
                ['value' => 'barisal', 'price' => 100],
                ['value' => 'bhola', 'price' => 120],
                ['value' => 'jhalokathi', 'price' => 110],
                ['value' => 'patuakhali', 'price' => 105],
                ['value' => 'pirojpur', 'price' => 115],
                ['value' => 'barguna', 'price' => 95],
            ],
            'chittagong' => [
                ['value' => 'chittagong', 'price' => 130],
                ['value' => 'comilla', 'price' => 125],
                ['value' => 'coxsbazar', 'price' => 140],
                ['value' => 'feni', 'price' => 115],
                ['value' => 'khagrachari', 'price' => 135],
                ['value' => 'lakshmipur', 'price' => 120],
                ['value' => 'bandarban', 'price' => 150],
                ['value' => 'noakhali', 'price' => 110],
                ['value' => 'rangamati', 'price' => 145],
                ['value' => 'brahmanbaria', 'price' => 130],
                ['value' => 'chandpur', 'price' => 125],
            ],
            'dhaka' => [
                ['value' => 'dhaka', 'price' => 150],
                ['value' => 'faridpur', 'price' => 135],
                ['value' => 'gazipur', 'price' => 140],
                ['value' => 'gopalganj', 'price' => 130],
                ['value' => 'kishoreganj', 'price' => 125],
                ['value' => 'madaripur', 'price' => 120],
                ['value' => 'manikganj', 'price' => 115],
                ['value' => 'munshiganj', 'price' => 110],
                ['value' => 'narayanganj', 'price' => 145],
                ['value' => 'narsingdi', 'price' => 130],
                ['value' => 'rajbari', 'price' => 135],
                ['value' => 'shariatpur', 'price' => 125],
                ['value' => 'tangail', 'price' => 140],
                ['value' => 'jamalpur', 'price' => 120],
            ],
            'khulna' => [
                ['value' => 'khulna', 'price' => 160],
                ['value' => 'bagerhat', 'price' => 145],
                ['value' => 'chuadanga', 'price' => 130],
                ['value' => 'jessore', 'price' => 135],
                ['value' => 'jhenaidah', 'price' => 125],
                ['value' => 'kushtia', 'price' => 120],
                ['value' => 'magura', 'price' => 115],
                ['value' => 'meherpur', 'price' => 110],
                ['value' => 'narail', 'price' => 105],
                ['value' => 'satkhira', 'price' => 140],
            ],
            'mymensingh' => [
                ['value' => 'mymensingh', 'price' => 155],
                ['value' => 'netrokona', 'price' => 130],
                ['value' => 'sherpur', 'price' => 125],
                ['value' => 'jamalpur', 'price' => 120],
            ],
            'rajshahi' => [
                ['value' => 'rajshahi', 'price' => 150],
                ['value' => 'bogra', 'price' => 140],
                ['value' => 'chapainawabganj', 'price' => 135],
                ['value' => 'joypurhat', 'price' => 130],
                ['value' => 'naogaon', 'price' => 125],
                ['value' => 'natore', 'price' => 120],
                ['value' => 'pabna', 'price' => 115],
                ['value' => 'sirajganj', 'price' => 110],
            ],
            'rangpur' => [
                ['value' => 'rangpur', 'price' => 145],
                ['value' => 'dinajpur', 'price' => 140],
                ['value' => 'gaibandha', 'price' => 135],
                ['value' => 'kurigram', 'price' => 130],
                ['value' => 'lalmonirhat', 'price' => 125],
                ['value' => 'nilphamari', 'price' => 120],
                ['value' => 'panchagarh', 'price' => 115],
                ['value' => 'thakurgaon', 'price' => 110],
            ],
            'sylhet' => [
                ['value' => 'sylhet', 'price' => 155],
                ['value' => 'habiganj', 'price' => 140],
                ['value' => 'maulvibazar', 'price' => 135],
                ['value' => 'sunamganj', 'price' => 130],
            ],
        ];

        foreach ($DIVISIONS as $division => $locations) {
            $division = Location::create([
                'value' => $division,
                'label' => ucwords($division),
            ]);
            foreach ($locations as $location) {
                $division->districts()->create([
                    'value' => $location['value'],
                    'label' => ucwords($location['value']),
                    'price' => $location['price'],
                ]);
            }
        }
    }
}
