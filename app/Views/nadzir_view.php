<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <title>Data Tanah Wakaf</title>
</head>
<style>
    * {margin:-6px; padding:0;}
    body{
        background-image: url('https://telegra.ph/file/00447a4f3112c485abaa8.jpg');
    }

    nav {
     margin:auto;
     text-align: center;
     width: 120%;
    } 

    nav ul ul {
     display: none;
    }

    nav ul li:hover > ul{
    display: block;
    width: 150px;
    }

    nav ul {
     background: white;
     padding: 0 20px;
     list-style: none;
     position: relative;
     display: inline-table;
     width: 100%;
    }

    nav ul:after {
     content: ""; 
     clear:both; 
     display: block;
    }

    nav ul li{
     float:left;
    }

    nav ul li:hover{
     background:#666;
    }

    nav ul li:hover a{
     color:black;
    }


    nav ul ul{
     background: #53bd84;
     border-radius: 0px;
     padding: 0;
     position: absolute;
     top:100%;
    }

    nav ul ul li{
     float:none;
     border-top: 1px soild #53bd84;
     border-bottom: 1px solid #53bd84;
     position: relative;
    }

    th{
        border:2px solid black;
    }





    nav ul ul ul{
     position: absolute;
     left: 100%;
     top: 0;
    }
		tr, td{ 
  		border: 2px solid black;
		padding: 8px;
		color : black;
        text-align:center;

	}
        table {
            margin: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        }
        input, textarea, {
         background: none;
         text-align: center;
         border: 2px solid #3498db;
         padding: 16px 20px;
         outline: none;
         color: black;
         border-radius: 24px;
        }
        .new{
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .navbar{
            margin:auto;
            text-align: center;
            width: 100%;
            padding-left:30px
        }
        .search{
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

    </style>
<body>
    <center><table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tupoksi</th>
                <th>Alamat</th>
                <th>Surat Keterangan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nadzir as $row) : ?>
                <tr>
                    <td><?= $row['NadzirWakaf']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['jabatan']; ?></td>
                    <td><?= $row['tupoksi']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= $row['sk']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <a href=<?= base_url("nadzir/edit/{$row['NadzirWakaf']}"); ?> class ="new">
                            Edit Manual
                        </a>
                        <a href=<?= base_url("nadzir/delete/{$row['NadzirWakaf']}"); ?> class ="new">
                            Delete Data
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href=<?= base_url("nadzir/add_new"); ?> class="new">
        Entry Data </a><br><br>
    </a>
    <a href=<?= base_url("homepage"); ?> class="new">
        Menu Admin </a><br><br>
    </a>
    <a href=logout class="new">
        Logout </a><br><br>
    </a>
    <a href=<?= base_url("tanah/polygonsumedang"); ?> class="new">
        Maps </a><br><br>
    </a>
    <a href=<?= base_url("tanah/index"); ?> class="new">
        Tanah </a><br><br>
    </a>
    <a href=<?= base_url("kecamatan/index"); ?>  class="new">
        Kecamatan </a><br><br>
    </a>
</body>

</html>