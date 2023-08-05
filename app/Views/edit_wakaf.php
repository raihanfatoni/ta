<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Data</title>
</head>
<style>
    body{
        background-image: url('https://telegra.ph/file/00447a4f3112c485abaa8.jpg');
    }
	a:link, a:visited {
        margin : 20px auto;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

	label,h3{
		color: white;
        font-size: 20px;
	}
    .box{
		width: 400px;
  		padding: 10px;
  		border: 5px solid white;
  		margin-top: 100px;
		background: transparent;
	}
	input{
         background: white;
         text-align: center;
         border: 2px solid #3498db;
         padding: 16px 20px;
         outline: none;
         color: black;
         border-radius: 10px;
         margin: 30px;
        }
        a,button{
            background-color: #3498db;
  color: white;
  padding: 15px;
  text-align: center;
  text-decoration: none;
        }
    </style>
<center><body>
    <form action=<?= base_url("/wakaf/update") ?> method="post">
    <div class="box">
        <h3>Form Entry Data Tanah</h3>
        <input type="hidden" name="no" value="<?= $wakaf->no; ?>">
        <div><label>Lokasi Tanah</label><input type="text" value= <?= $wakaf->wilayah?>  name="wilayah" class="form-control"></div>
        <div><label>Mandor Wakaf</label><input type="text" value= <?= $wakaf->mandor?>  name="mandor" class="form-control"></div>
        <div><label>Jumlah Penggarap </label><input type="text" value= <?= $wakaf->jumlahpenggarap?>  name="jumlahpenggarap" class="form-control"></div>
        <div><label>Luas Tanah</label><input type="text" value= <?= $wakaf->luas?>  name="luas" class="form-control"></div>
        <div><label>Setoran Panen </label><input type="text" value= <?= $wakaf->setoranpanen?>  name="setoranpanen" class="form-control"></div>
        <div><label>Titik Marker</label><input type="text" value= <?= $wakaf->marker?>  name="marker" class="form-control"></div>
        <div><label>Google Earth</label><input type="text" value= <?= $wakaf->googleearth?>  name="googleearth" class="form-control"></div>
        <div><label>ID Kecamatan</label><input type="text" value= <?= $wakaf->id_polygonkecamatan?>  name="id_polygonkecamatan" class="form-control"></div>
        <button type="submit">Update</button>
        </div>
    </form>
</body></center>

</html>
