<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'title' => 'JUEGO 5 PIEZAS DESARMADOR MANUAL DE IMPACTO',
            'code' => '710',
            'slug' => '710_1',
            'priceDis' => 232.76,
            'pricePub' => 340.52,
            'status' => false,
            'brand_id' => 1,
        ]);
        $product1 = Product::create([
            'title' => 'JUEGO  21 PIEZAS DE MACHUELOS HSS M3-M12',
            'code' => '1924',
            'slug' => '1924_1',
            'priceDis' => 345.68,
            'pricePub' => 512.93,
            'status' => false,
            'brand_id' => 1,
        ]);
        $product2 = Product::create([
            'title' => 'ESCUADRA MAGNETICA EXTRA FUERTE HASTA 22 KG',
            'code' => '3008',
            'slug' => '3008_1',
            'priceDis' => 60.80,
            'pricePub' => 85.34,
            'status' => false,
            'brand_id' => 1,
        ]);
        $product3 = Product::create([
            'title' => 'JUEGO 27 PIEZAS DE DADOS 1/2"  8-32 MM',
            'code' => '2224',
            'slug' => '2224_1',
            'priceDis' => 1133.64,
            'pricePub' => 1507.75,
            'status' => false,
            'brand_id' => 1,
        ]);
        $product4 = Product::create([
            'title' => 'Llanta neumática 14" con rin para carretilla',
            'code' => 'ctfr2',
            'slug' => 'ctfr2_2',
            'priceDis' => 167,
            'pricePub' => 205,
            'status' => false,
            'brand_id' => 2,
        ]);
        $product5 = Product::create([
            'title' => 'Pinza pelacables para fibra óptica',
            'code' => '310',
            'slug' => '310_2',
            'priceDis' => 406,
            'pricePub' => 500,
            'status' => false,
            'brand_id' => 2,
        ]);
        $product6 = Product::create([
            'title' => 'Prensa rápida 12"',
            'code' => '107097',
            'slug' => '107097_3',
            'priceDis' => 118,
            'pricePub' => 145,
            'status' => false,
            'brand_id' => 3,
        ]);
    }
}
