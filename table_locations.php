<html>
  <body>
<h2>Data Locations</h2>
<hr>
<table border="1">
    <tr>
      <td><b>Nama</b></td>
      <td><b>Latitude</b></td>
      <td><b>Longtitude</b></td>
    </tr>
<?php
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
    ?>
      <tr>
        <td><?php echo $nama?></td>
        <td><?php echo $lat?></td>
        <td><?php echo $long?></td>
      </tr>
    <?php
  }
  fclose($file); 
  //tutup akses file csv
?>
</table>
</body>
</html>