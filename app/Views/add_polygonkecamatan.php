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
<center>
<body>
    <form action=<?= base_url("/polygonkecamatan/save") ?> method="post">
    <div class="box">
        <h3>Form Entry Data Kecamatan</h3>
        <div><label>ID Kecamatan : </label><input type="text" name="id_polygonkecamatan" class="form-control"></div>
        <div><label>Nama Kecamatan</label><input type="text" name="nama" class="form-control"></div>
        <div><label>Luas Kecamatan</label><input type="text" name="luas" class="form-control"></div>
        <div><label>Akumulasi Luas Tanah Wakaf</label><input type="text" name="akumulasiluastanah" class="form-control"></div>
        <div><label>Akumulasi Jumlah Penggarap</label><input type="text" name="akumulasijumlahpenggarap" class="form-control"></div>
        <div><label>Jumlah Tanah Wakaf</label><input type="text" name="jumlahtanahwakaf" class="form-control"></div>
        <div><label>Titik Polygon : </label><input type="text" name="polygon" class="form-control"></div>
        <button type="submit">Save</button>
        </div>
    </form>
</body>
</center>

</html>
