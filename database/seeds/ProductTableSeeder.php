<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 30; $i++) {
            $firstImage = $faker->image($dir = storage_path() . '/app/public/products', 640, 480);
            $secondImage = $faker->image($dir = storage_path() . '/app/public/products', 640, 480);
            $firstImageFile = new File($firstImage);
            $secondImageFile = new File($secondImage);
            Storage::disk('public')->putFile('products', $firstImageFile);
            Storage::disk('public')->putFile('products', $secondImageFile);
            $firstImageName = "products\/".$firstImageFile->getBasename();
            $secondImageName = "products\/".$secondImageFile->getBasename();
            DB::table('products')->insert([
                'name' => $faker->name,
                'is_new' => $faker->boolean,
                'is_discount' => 0,
                'description' => $faker->realText(),
                'price' => $faker->randomFloat('3', '0', '1000'),
                'size' => '["S","M", "L", "XL"]',
                'quantity' => $faker->randomNumber(),
                'images' => json_encode(array($firstImageName, $secondImageName)),
                'category_id' => rand(1,6),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
