<?php

function hitung_jarak($lat, $long){
    $pangkat = 2;
    $long_ts = 110.81423;
    $lat_ts = -7.56526;

    $hasil_lat = (float)$lat-$lat_ts;
    $hasil_long = (float)$long-$long_ts;
    $hitung_jarak = sqrt(pow($hasil_lat, $pangkat)+pow($hasil_long, $pangkat));
    return $hitung_jarak;

}


function push_array(){
    $file = fopen("locations.csv","r"); //buka file csv
    $no=0;
  //cari akhir baris csv
    while(!feof($file)){
    $myfile = fgets($file);
    if($no == 0){
        $no++;
        continue;
    }
    $res = explode("," , $myfile);
    $nama = $res['0'];
    $lat = str_replace('"' , "", $res['1']);
    $long = str_replace('"' , "", $res['2']);
    $jarak = hitung_jarak($lat, $long);
    }
    
    $csv_array=["lokasi"=> $nama, "latitude"=>$lat, "longtitude"=>$long, "jarak"=>$jarak];

    array_push($data, $csv_array);
    $col_jarak = array_column($data, "jarak");
    $a = array_multisort($col_jarak, SORT_ASC, $csv_array);
    var_dump($a);
    fclose($file); 
  //tutup akses file csv
}

?>