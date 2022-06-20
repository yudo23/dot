<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
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
            $province = Rajaongkir::provinsi()->all();

            foreach($province as $index => $row){
                Province::firstOrCreate([
                    'province_id' => $row["province_id"],
                    'name' => $row['province'],
                ],[
                    'province_id' => $row["province_id"],
                    'name' => $row['province'],
                ]);

                $city = Rajaongkir::kota()->dariProvinsi($row["province_id"])->get();

                foreach($city as $i => $v){
                    City::firstOrCreate([
                        'province_id' => $row["province_id"],
                        'city_id' => $v["city_id"],
                        'name' => $v["city_name"],
                    ],[
                        'province_id' => $row["province_id"],
                        'city_id' => $v["city_id"],
                        'name' => $v["city_name"],
                    ]);
                }
            }

            DB::commit();

        }catch(\Throwable $th){
            DB::rollback();
        }
    }
}
