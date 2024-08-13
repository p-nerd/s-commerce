<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Option::addNewsFlash(
            '100% Secure delivery without contacting the courier',
        );
        Option::addNewsFlash(
            'Supper Value Deals - Save more with coupons',
        );
        Option::addNewsFlash(
            'Trendy 25silver jewelry, save up 35% off today',
        );

        Option::setSupportNumber(
            '017xxxxxxxx'
        );

        Option::addHeroSlider(
            heading1: 'Don’t miss amazing 2',
            heading2: 'grocery deals 2',
            subheading: 'Sign up for the daily newsletter 2',
            image: '/assets/imgs/slider/slider-1.png'
        );
        Option::addHeroSlider(
            heading1: 'Frash Vagitable',
            heading2: 'Big Discount',
            subheading: 'Save 50 % off',
            image: '/assets/imgs/slider/slider-2.png'
        );
    }
}
