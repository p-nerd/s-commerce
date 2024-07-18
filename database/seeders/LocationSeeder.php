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
                ['label' => 'Barisal', 'value' => 'barisal', 'price' => 100],
                ['label' => 'Bhola', 'value' => 'bhola', 'price' => 120],
                ['label' => 'Jhalokathi', 'value' => 'jhalokathi', 'price' => 110],
                ['label' => 'Patuakhali', 'value' => 'patuakhali', 'price' => 105],
                ['label' => 'Pirojpur', 'value' => 'pirojpur', 'price' => 115],
                ['label' => 'Barguna', 'value' => 'barguna', 'price' => 95],
            ],
            'chittagong' => [
                ['label' => 'Chittagong', 'value' => 'chittagong', 'price' => 130],
                ['label' => 'Comilla', 'value' => 'comilla', 'price' => 125],
                ['label' => "Cox's Bazar", 'value' => 'coxsbazar', 'price' => 140],
                ['label' => 'Feni', 'value' => 'feni', 'price' => 115],
                ['label' => 'Khagrachari', 'value' => 'khagrachari', 'price' => 135],
                ['label' => 'Lakshmipur', 'value' => 'lakshmipur', 'price' => 120],
                ['label' => 'Bandarban', 'value' => 'bandarban', 'price' => 150],
                ['label' => 'Noakhali', 'value' => 'noakhali', 'price' => 110],
                ['label' => 'Rangamati', 'value' => 'rangamati', 'price' => 145],
                ['label' => 'Brahmanbaria', 'value' => 'brahmanbaria', 'price' => 130],
                ['label' => 'Chandpur', 'value' => 'chandpur', 'price' => 125],
            ],
            'dhaka' => [
                ['label' => 'Dhaka', 'value' => 'dhaka', 'price' => 150],
                ['label' => 'Faridpur', 'value' => 'faridpur', 'price' => 135],
                ['label' => 'Gazipur', 'value' => 'gazipur', 'price' => 140],
                ['label' => 'Gopalganj', 'value' => 'gopalganj', 'price' => 130],
                ['label' => 'Kishoreganj', 'value' => 'kishoreganj', 'price' => 125],
                ['label' => 'Madaripur', 'value' => 'madaripur', 'price' => 120],
                ['label' => 'Manikganj', 'value' => 'manikganj', 'price' => 115],
                ['label' => 'Munshiganj', 'value' => 'munshiganj', 'price' => 110],
                ['label' => 'Narayanganj', 'value' => 'narayanganj', 'price' => 145],
                ['label' => 'Narsingdi', 'value' => 'narsingdi', 'price' => 130],
                ['label' => 'Rajbari', 'value' => 'rajbari', 'price' => 135],
                ['label' => 'Shariatpur', 'value' => 'shariatpur', 'price' => 125],
                ['label' => 'Tangail', 'value' => 'tangail', 'price' => 140],
                ['label' => 'Jamalpur', 'value' => 'jamalpur', 'price' => 120],
            ],
            'khulna' => [
                ['label' => 'Khulna', 'value' => 'khulna', 'price' => 160],
                ['label' => 'Bagerhat', 'value' => 'bagerhat', 'price' => 145],
                ['label' => 'Chuadanga', 'value' => 'chuadanga', 'price' => 130],
                ['label' => 'Jessore', 'value' => 'jessore', 'price' => 135],
                ['label' => 'Jhenaidah', 'value' => 'jhenaidah', 'price' => 125],
                ['label' => 'Kushtia', 'value' => 'kushtia', 'price' => 120],
                ['label' => 'Magura', 'value' => 'magura', 'price' => 115],
                ['label' => 'Meherpur', 'value' => 'meherpur', 'price' => 110],
                ['label' => 'Narail', 'value' => 'narail', 'price' => 105],
                ['label' => 'Satkhira', 'value' => 'satkhira', 'price' => 140],
            ],
            'mymensingh' => [
                ['label' => 'Mymensingh', 'value' => 'mymensingh', 'price' => 155],
                ['label' => 'Netrokona', 'value' => 'netrokona', 'price' => 130],
                ['label' => 'Sherpur', 'value' => 'sherpur', 'price' => 125],
                ['label' => 'Jamalpur', 'value' => 'jamalpur', 'price' => 120],
            ],
            'rajshahi' => [
                ['label' => 'Rajshahi', 'value' => 'rajshahi', 'price' => 150],
                ['label' => 'Bogra', 'value' => 'bogra', 'price' => 140],
                ['label' => 'Chapainawabganj', 'value' => 'chapainawabganj', 'price' => 135],
                ['label' => 'Joypurhat', 'value' => 'joypurhat', 'price' => 130],
                ['label' => 'Naogaon', 'value' => 'naogaon', 'price' => 125],
                ['label' => 'Natore', 'value' => 'natore', 'price' => 120],
                ['label' => 'Pabna', 'value' => 'pabna', 'price' => 115],
                ['label' => 'Sirajganj', 'value' => 'sirajganj', 'price' => 110],
            ],
            'rangpur' => [
                ['label' => 'Rangpur', 'value' => 'rangpur', 'price' => 145],
                ['label' => 'Dinajpur', 'value' => 'dinajpur', 'price' => 140],
                ['label' => 'Gaibandha', 'value' => 'gaibandha', 'price' => 135],
                ['label' => 'Kurigram', 'value' => 'kurigram', 'price' => 130],
                ['label' => 'Lalmonirhat', 'value' => 'lalmonirhat', 'price' => 125],
                ['label' => 'Nilphamari', 'value' => 'nilphamari', 'price' => 120],
                ['label' => 'Panchagarh', 'value' => 'panchagarh', 'price' => 115],
                ['label' => 'Thakurgaon', 'value' => 'thakurgaon', 'price' => 110],
            ],
            'sylhet' => [
                ['label' => 'Sylhet', 'value' => 'sylhet', 'price' => 155],
                ['label' => 'Habiganj', 'value' => 'habiganj', 'price' => 140],
                ['label' => 'Maulvibazar', 'value' => 'maulvibazar', 'price' => 135],
                ['label' => 'Sunamganj', 'value' => 'sunamganj', 'price' => 130],
            ],
        ];

        foreach ($DIVISIONS as $division => $locations) {
            $division = Location::create([
                'value' => $division,
                'label' => $division,
            ]);
            foreach ($locations as $location) {
                Location::create([
                    'value' => $location['value'],
                    'label' => $location['label'],
                    'price' => $location['price'],
                    'division_id' => $division->id,
                ]);
            }
        }
    }
}
