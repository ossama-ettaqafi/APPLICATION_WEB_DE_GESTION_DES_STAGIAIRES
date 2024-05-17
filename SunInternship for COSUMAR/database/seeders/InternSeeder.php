<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Intern;

class InternSeeder extends Seeder
{
    public function run()
    {
        $interns = [
            [
                'firstName' => 'Stan',
                'lastName' => 'Kovacek',
                'age' => 21,
                'address' => '73945 Walter Spring Suite 795 South Frieda, WI 02553-2656',
                'school' => 'Barrows-Buckridge',
                'cin' => '72992241',
                'phone' => '860-552-4741',
                'sector' => 'Makeup Artists',
                'startDate' => '2023-04-21',
                'endDate' => '2023-05-21',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Alexie',
                'lastName' => 'Conn',
                'age' => 24,
                'address' => '40137 Bernhard Lakes Apt. 518 Macitown, MD 23980-1905',
                'school' => 'Kemmer-Koelpin',
                'cin' => '2074795',
                'phone' => '531.223.9164',
                'sector' => 'Air Crew Member',
                'startDate' => '2023-04-21',
                'endDate' => '2023-05-21',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Kamille',
                'lastName' => 'Nikolaus',
                'age' => 25,
                'address' => '589 O\'Conner Shoal Theresiashire, MS 92812',
                'school' => 'Strosin, Wiza and Ledner',
                'cin' => '74988754',
                'phone' => '346.916.7429',
                'sector' => 'Chemical Equipment Tender',
                'startDate' => '2023-03-01',
                'endDate' => '2023-08-31',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Jean',
                'lastName' => 'Medhurst',
                'age' => 30,
                'address' => '4591 Jaleel Island Lake Melynaview, VA 00007',
                'school' => 'O\'Reilly LLC',
                'cin' => '58487359',
                'phone' => '(872) 246-9269',
                'sector' => 'Personal Financial Advisor',
                'startDate' => '2023-01-01',
                'endDate' => '2024-01-20',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Kennedi',
                'lastName' => 'Padberg',
                'age' => 20,
                'address' => '67988 Cesar Corner Apt. 891 Wolfside, CA 83348-8833',
                'school' => 'Goodwin-Goyette',
                'cin' => '88380117',
                'phone' => '1-774-541-7904',
                'sector' => 'Benefits Specialist',
                'startDate' => '2023-12-09',
                'endDate' => '2024-01-30',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Jewel',
                'lastName' => 'Rosenbaum',
                'age' => 19,
                'address' => '521 Rod Village Apt. 462 Port Janice, SD 47002-1117',
                'school' => 'Kreiger and Purdy',
                'cin' => '11177657',
                'phone' => '417-827-9588',
                'sector' => 'Sociologist',
                'startDate' => '2023-10-01',
                'endDate' => '2024-10-01',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Estella',
                'lastName' => 'Franecki',
                'age' => 21,
                'address' => '13549 Vicenta Village Suite 830 Ernsermouth, CA 08263-2886',
                'school' => 'Franecki, Strosin and Greenholt',
                'cin' => '72928650',
                'phone' => '+1-848-471-0532',
                'sector' => 'Central Office and PBX Installers',
                'startDate' => '2023-06-18',
                'endDate' => '2023-09-04',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Magnolia',
                'lastName' => 'Hodkiewicz',
                'age' => 19,
                'address' => '74799 Franecki Stream Suite 895 Lake Alanastad, WI 53902-7335',
                'school' => 'Jaskolski-Crooks',
                'cin' => '11365537',
                'phone' => '689.572.0886',
                'sector' => 'Ship Mates',
                'startDate' => '2023-09-03',
                'endDate' => '2023-12-23',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Verner',
                'lastName' => 'Botsford',
                'age' => 19,
                'address' => '27281 Neva Street Lake Brisa, MA 71263-7168',
                'school' => 'Kessler, Macejkovic and Gerhold',
                'cin' => '54240766',
                'phone' => '724.713.4907',
                'sector' => 'Power Plant Operator',
                'startDate' => '2023-01-01',
                'endDate' => '2024-01-01',
                'image' => '/images/intern.png',
            ],
            [
                'firstName' => 'Darron',
                'lastName' => 'Douglas',
                'age' => 28,
                'address' => '5530 Ashleigh Squares Suite 720 D\'Amoreville, VA 24779',
                'school' => 'Koss, Raynor and Legros',
                'cin' => '92955402',
                'phone' => '307-263-8540',
                'sector' => 'Business Teacher',
                'startDate' => '2023-05-16',
                'endDate' => '2023-05-16',
                'image' => '/images/intern.png',
            ],
        ];

        foreach ($interns as $intern) {
            Intern::create($intern);
        }
    }
}
