<?php
namespace App\Providers;
use Illuminate\Support\Facades\Storage;
 class workWithRegions2
 {
   static function getRegionsFromRawJson($Json="https://gist.githubusercontent.com/alex-oleshkevich/1509c308fabab9e104b5190dab99a77b/raw/b20bd8026deec00205a57d395c0ae1f75cc387bb/ua-cities.json")
   {
       $p=Storage::url("app/public/regions.json");
      $get = file_get_contents($Json);
       $res= json_decode($get,true);
       return $res[0]["regions"];
   }

    static function getAllRegions()
    {
      $regions=workWithRegions2::getRegionsFromRawJson();
          $regionsNames =[];
                 for($i=0 ; $i<count($regions);++$i) {
                     $regionsNames[]=$regions[$i]["name"];
                 }
       return $regionsNames;
    }


    static function getRegionByIndex($index)
    {
    $regionsNames=workWithRegions2::getAllRegions();
    return $regionsNames[$index];
    }


    static function getCitiesByRegionIndex($index)
    {
    $id=intval($index);
    $regions=workWithRegions2::getRegionsFromRawJson();
    $cities=null;
    $cities=[];
        for ($j = 0; $j < count($regions[$id]["cities"]); $j++) {
          array_push($cities,$regions[$id]["cities"][$j]["name"]);
         }
     return $cities;
    }
}
