<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;

class WilayahController extends Controller
{
    public function __construct(){
        $this->province = new Province();
        $this->city = new City();
    }

    public function province(Request $request){
        $data_json = [];
        try {
            $province_id = trim(htmlentities($request->input("province_id")));

            if(env("CALL_API_FROM") == "databases"){
                
                $get_province = $this->province;
                if(!empty($province_id)){
                    $get_province = $get_province->where("province_id",$province_id);
                }
                $get_province = $get_province->get();

                $data_json["IsError"] = FALSE;
                $data_json["Message"] = "Data provinsi berhasil didapatkan";
                $data_json["Data"] = $get_province;
                goto ResultData;
            }
            else if(env("CALL_API_FROM") == "online"){

                $response = Http::withHeaders([
                    'key' => env("RAJAONGKIR_API_KEY"),
                ])->get('https://api.rajaongkir.com/starter/province?province='.$province_id);

                $response = $response->json();

                if($response["rajaongkir"]["status"]["code"] != 200){
                    $data_json["IsError"] = TRUE;
                    $data_json["Message"] = $response["rajaongkir"]["status"]["description"];
                    goto ResultData;
                }

                $response = $response["rajaongkir"]["results"];
                
                $data_json["IsError"] = FALSE;
                $data_json["Message"] = "Data provinsi berhasil didapatkan";
                $data_json["Data"] = $response;
                goto ResultData;
            }
            else{
                $data_json["IsError"] = TRUE;
                $data_json["Message"] = "Konfigurasi CALL_API_FROM belum tersedia";
                goto ResultData;
            }

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function cities(Request $request){
        $data_json = [];
        try {
            $city_id = trim(htmlentities($request->input("city_id")));

            if(env("CALL_API_FROM") == "databases"){

                $get_cities = $this->city;
                if(!empty($city_id)){
                    $get_cities = $get_cities->where("city_id",$city_id);
                }
                $get_cities = $get_cities->get();

                $data_json["IsError"] = FALSE;
                $data_json["Message"] = "Data cities berhasil didapatkan";
                $data_json["Data"] = $get_cities;
                goto ResultData;
            }
            else if(env("CALL_API_FROM") == "online"){

                $response = Http::withHeaders([
                    'key' => env("RAJAONGKIR_API_KEY"),
                ])->get('https://api.rajaongkir.com/starter/city?id='.$city_id);

                $response = $response->json();

                if($response["rajaongkir"]["status"]["code"] != 200){
                    $data_json["IsError"] = TRUE;
                    $data_json["Message"] = $response["rajaongkir"]["status"]["description"];
                    goto ResultData;
                }

                $response = $response["rajaongkir"]["results"];
                
                $data_json["IsError"] = FALSE;
                $data_json["Message"] = "Data cities berhasil didapatkan";
                $data_json["Data"] = $response;
                goto ResultData;

            }
            else{
                $data_json["IsError"] = TRUE;
                $data_json["Message"] = "Konfigurasi CALL_API_FROM belum tersedia";
                goto ResultData;
            }

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }
}
