<!DOCTYPE html>
<head>
    <title>Form Isian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
</head>
<?php
    if (isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $isi = "\n" . $nama . "," . '"' . $lat . "," . $long . '"';
    
    $fp = fopen('locations.csv', 'a');//opens file in append mode  
    fwrite($fp, $isi);  
    rewind($fp); 
    fclose($fp);  
    }
    ?>
<body>
    <form role="form" method="post" action="form_locations.php">
        <div class="col-md-6 mt-4">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" placeholder="Lokasi">
            </div>
            </div>
            <div class="form-group row">
            <label for="inputUser" class="col-sm-2 col-form-label">Latitude</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUser" name="lat" placeholder="Latitude">
            </div>
            </div>
            <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Longtitude</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" name="long" placeholder="Longtitude">
            </div>
            </div>
            <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
                <!-- <button type="btn btn-outline btn-primary" href="table_locations.php">Lihat Table</button> -->
            </div>
            </div>
        </div>
    </form>

    <hr>
    <div class="col-md-12 mt-4">
        <div class="col-md-6">
        <h2 class="mb-4">Data Locations</h2>
        <div class="table table-bordered">
        <table border="1">
            <tr class="table-primary">
              <td><b>Nama</b></td>
              <td><b>Latitude</b></td>
              <td><b>Longtitude</b></td>
              <td><b>Jarak</b></td>
            </tr>
        <?php
            include("hitung_jarak.php");
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
            ?>
              <tr>
                <td><?php echo $nama?></td>
                <td><?php echo $lat?></td>
                <td><?php echo $long?></td>
                <td><?php echo $jarak?></td>
              </tr>
            <?php
          }
          fclose($file); 
          //tutup akses file csv
        ?>
        </table>
    </div>
    
    <?php
        push_array();
        ?>
    </table>
    </div>
    </div>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</footer>
</html>
<!-- long = -7,56526
    110.81423
    r = sqrt(sqr(x2-x1)+sqr(y2-y1))-->