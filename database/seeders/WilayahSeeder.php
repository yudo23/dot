<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;
use DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try{
            $province = Http::withHeaders([
                'key' => env("RAJAONGKIR_API_KEY"),
            ])->get('https://api.rajaongkir.com/starter/province');

            $province = $province->json();

            if($province["rajaongkir"]["status"]["code"] != 200){
                DB::rollback();
            }

            $province = $province["rajaongkir"]["results"];

            foreach($province as $index => $row){
                Province::firstOrCreate([
                    'province_id' => $row["province_id"]
                ],[
                    'province_id' => $row["province_id"],
                    'province' => $row["province"],
                ]);
            }

            $city = Http::withHeaders([
                'key' => env("RAJAONGKIR_API_KEY"),
            ])->get('https://api.rajaongkir.com/starter/city');

            $city = $city->json();

            if($city["rajaongkir"]["status"]["code"] != 200){
                DB::rollback();
            }

            $city = $city["rajaongkir"]["results"];

            foreach($city as $index => $row){
                City::firstOrCreate([
                    'city_id' => $row["city_id"]
                ],[
                    'city_id' => $row["city_id"],
                    'province_id' => $row["province_id"],
                    'type' => $row["type"],
                    'city_name' => $row["city_name"],
                    'postal_code' => $row["postal_code"],
                ]);
            }

            DB::commit();

        }catch(\Throwable $th){
            DB::rollback();
        }
    }
}
