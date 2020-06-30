<?php
namespace App\Tools;
 class workWithRegions
 {
   public static function getRegionsFromRawJson($Json="https://gist.githubusercontent.com/alex-oleshkevich/1509c308fabab9e104b5190dab99a77b/raw/b20bd8026deec00205a57d395c0ae1f75cc387bb/ua-cities.json")
   {
      $get = file_get_contents($Json);
       $res= json_decode($get,true);
       return $res[0]["regions"];
   }

  public  static function getAllRegions()
    {
      $regions=workWithRegions::getRegionsFromRawJson();
          $regionsNames =[];
          $citiesNames=[];
          $s=[];
                 for($i=0 ; $i<count($regions);++$i) {
                     $regionsNames[]=$regions[$i]["name"];
                 }
       return $regionsNames;
    }


   public static function getRegionByIndex($index)
    {
    $regionsNames=workWithRegions::getAllRegions();
    return $regionsNames[$index];
    }


    static function getCitiesByRegionIndex($index)
    {
    $regions=workWithRegions::getRegionsFromRawJson();
    $cities=[];
        for ($j = 0; $j < count($regions[$index]["cities"]); $j++) {
          array_push($cities,$regions[$index]["cities"][$j]["name"]);
         }
       var_dump($cities);
     return $cities;
    }
}
