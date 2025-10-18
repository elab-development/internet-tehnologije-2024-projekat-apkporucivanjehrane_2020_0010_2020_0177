<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProizvodNaMeniju;
use App\Models\Restoran;
use Illuminate\Database\Seeder;

class RealniRestoranSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // McDonald's - Burger kategorija
        $burgerKategorija = Category::where('slug', 'burger')->first();
        
        $mcdonalds = Restoran::create([
            'category_id' => $burgerKategorija->id,
            'name' => "McDonald's Fontana",
            'slug' => 'mcdonalds-fontana',
            'description' => 'Brza hrana, burgeri i pomfrit. McDonald\'s nudi širok asortiman burgera, salata, deserata i napitaka.',
            'address' => 'Narodnih heroja 2, 11070 Beograd',
            'phone' => '+381 11 222 3344',
            'image' => 'https://images.unsplash.com/photo-1623156346149-d5cec8b29818?w=400',
            'delivery_price' => 150.00,
            'delivery_time' => 25,
            'is_active' => true,
        ]);

        // Proizvodi za McDonald's
        $proizvodi = [
            [
                'name' => 'Veliki pomfrit',
                'description' => 'Hrskav pomfrit pripremljen od svežih krompira',
                'price' => 400.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0077bb1c0857720cfb1ad/383be8ca-f00d-11ed-8857-56b4077a3a28_wlt_rs_2020.jpg?w=960',
            ],
            [
                'name' => 'BigMac obrok',
                'description' => 'Dva sočna burgera od 100% govedine, Big Mac® sos, salata, sir, kiseli krastavci i luk na susamovoj lepini',
                'price' => 1190.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0077bb1c0857720cfb1ad/37c51f10-f00d-11ed-9b5a-7e2e0f2275d2_wlt_rs_5110.jpg?w=960',
            ],
            [
                'name' => 'Dupli Cheeseburger',
                'description' => 'Dva sočna burgera od 100% govedine sa sirom, kiselim krastavcima, lukom, kečapom i senfom',
                'price' => 630.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0077bb1c0857720cfb1ad/37e5b73e-f00d-11ed-9b5a-7e2e0f2275d2_wlt_rs_1030.jpg?w=960',
            ],
            [
                'name' => 'Steakhouse Classic',
                'description' => 'Sočan burger sa chutney sosom od crnog luka, slanina, cheddar sir',
                'price' => 1139.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0080365f3ab8b6a29c27a/6afbac58-9e3b-11f0-89ed-e632e7d0b8f6_wlt_rs_1161.jpg?w=960',
            ],
            [
                'name' => 'McCrispy Burger',
                'description' => 'Hrskavo panirano pile, svež salata, majonez i susamova lepinja',
                'price' => 900.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0080365f3ab8b6a29c27a/a0d5fd5e-7d0f-11ef-a9a4-6af098512755_wlt_rs_1074a.jpg?w=960',
            ],
            [
                'name' => 'Big Tasty Classic',
                'description' => 'Sočan burger od govedine sa Big Tasty sosom, emmental sirom, salatom i paradajzom',
                'price' => 1130.00,
                'image' => 'https://imageproxy.wolt.com/menu/menu-images/61e0080365f3ab8b6a29c27a/400af972-2b29-11ee-a339-5e54d798874b_wlt_rs_1153.jpg?w=960',
            ],
        ];

        foreach ($proizvodi as $proizvod) {
            ProizvodNaMeniju::create([
                'restoran_id' => $mcdonalds->id,
                'name' => $proizvod['name'],
                'description' => $proizvod['description'],
                'price' => $proizvod['price'],
                'image' => $proizvod['image'],
                'is_available' => true,
            ]);
        }
    }
}
