<?php
    $dropdownStruktur = [
        'name'=> 'strukturorg',
        'options'=> $struktur,
        'class'=> 'form-control'
    ];

    $submit = [
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Pilih Data',
        'class'=>'btn btn-primary',
        'type'=>'submit'
    ];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    
    <title>Dashboard</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" id="Navbar">
      <div class="container">
        <div class="logo">
          <img src="../image/logo.png" alt="">
          <a class="navbar-brand" href="#">SIG</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=<?= base_url("PolygonKecamatan/analisisLuas"); ?>>Pemetaan Tanah Wakaf</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn" href="login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <Header class="jumbotron-fluid" id="Header">
      <div class="container">
        <div class="row">
          <div class="col-6 contain">
            <h3>Sistem Informasi Geografis Berbasis Web untuk Digitalisasi Peninggalan Tanah Wakaf Pangeran Sumedang</h3>
            <P>Kerajaan ini didirikan pada tahun 721 M oleh Prabu Tajimalela, keturunan dari raja Wretikandayun dari Kerajaan Galuh, di wilayah bekas dari Kerajaan Tembong Agung. Kerajaan ini juga pernah dikenal dengan nama Kerajaan Himbar Buana sebelum berganti nama menjadi Sumedang Larang.Sumedang Larang berstatus sebagai bagian dari Kerajaan Sunda dan Galuh antara abad ke-8 sampai abad ke-16 M, dimana penguasanya berada di bawah penguasa kedua kerajaan tersebut.Ibu kota Sumedang Larang di saat pendiriannya berada di Citembong Girang, yang saat ini masuk dalam wilayah desa Cikeusi, Kec. Darmaraja, Kab. Sumedang.</P>
            <button class="nav-link btn" onclick="window.location.href='<?= base_url("PolygonKecamatan/analisisLuas"); ?>'">Cari Data Tanah Wakaf</button>
          </div>
          <div class="col-5 offset-1">
            <img src="../image/LogoKSLkecil.png" alt="">
          </div>
        </div>
      </div>
    </Header>
    <!-- End Header -->

    <!-- About -->
    <section class="container" id="About">
      <div class="row">
        <div class="col">
          <img src="../image/logoyps1.png" >
        </div>
        <div class="col">
          <div class="Header">
            <h2>Yayasan Nazhir Wakaf Pangeran Sumedang </h2>
          </div>
          <p class="body">Sistem informasi yang dibuat dilengkapi dengan fitur - fitur ditujukan untuk membantu para pengelola tanah wakaf Yayasan Pangeran Sumedang. Informasi yang disediakan berupa persebaran tanah wakaf pada 6 kecamatan yaitu Tanjungkerta, Sumedang Utara, Sumedang Selatan, Darmaraja, Buahdua dan Conggeang. Di bawah ini merupakan jumlah tanah wakaf yang berada pada masing - masing kecamatan :</p>
          <!-- <span class="square">Sebaran Tanah Wakaf</span> -->
          <div class="Card shadow-sm">
            <div class="contain one">
              <div class ="row">
                <div class = "col d-flex justify-content-between"> 
                  <p>Tanjungkerta</p>
                  <p>Sumedang Utara</p>
                  <p>Darmaraja</p>
                </div>
              </div>
              <div class ="row">
                <div class = "col d-flex justify-content-between"> 
                  <h3 class = "col-4 pe-5">1</h3>
                  <h3 class = "col-4 ps-3 ms-2 ">2</h3>
                  <h3 class = "col-4 ps-5 ">1</h3>
                </div>
              </div>
            </div>
        </div>
            <div class="Card shadow-sm">
              <div class="contain one">
                <div class ="row">
                  <div class = "col d-flex justify-content-between"> 
                    <p>Conggeang</p>
                    <p>Sumedang Selatan</p>
                    <p>Buahdua</p>
                  </div>
                </div>
                <div class ="row">
                  <div class = "col d-flex justify-content-between"> 
                    <h3 class = "col-4 pe-5">1</h3>
                    <h3 class = "col-4 ps-3 ms-2 ">11</h3>
                    <h3 class = "col-4 ps-5 ">1</h3>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>
    <!-- End About -->

    <!-- Service -->
    <section class="container" id="Service">
      <?= form_open('/') ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-10">
                        <b> Pilih Informasi Struktur </b>
                        <?= form_dropdown($dropdownStruktur) ?>
                    </div>
                    <div class="col-md-2 pt-4">
                        <?= form_submit($submit) ?>
                    </div>
                </div>
            <?= form_close() ?>
      <div class="Header">
      </div>
      <div class="row">
        <?php 
        if($pilihStruktur == 1 ){
          foreach ($nadzir as $row=>$value) : ?>
              <div class="col-sm-4">
                  <div class="Card shadow-sm">
                      <h3 class="text-center"><?= $value['tupoksi']?></h3>
                      <img src="<?= $value['img'] ?>" >
                      <p> Keanggotaan beliau tercantum pada surat keterangan nomor <?= $value['sk']?>. Secara keturunan beliau <?= $value['status']?> terhadap leluhur Kerajaan Sumedang Larang. Beliau bertempat tinggal di <?= $value['alamat']?>.</p>
                      <button class="btn container-fluid"><?= $value['nama']?></button>
                      <button class="btn container-fluid"><?= $value['jabatan']?></button>

                  </div>
              </div>
          <?php endforeach;
        } else {
          echo '<div class = "w-100 text-center">
            <img class = "bagan" src="../image/struktur.drawio.png" alt="Description of image">
          </div>';
        }
        ?>
      </div>     
    </section>  
    <!-- End Service -->

    
    <!-- Footer -->
    <footer class="jumbotron-fluid" id="Footer">
      <div class="container">
        <div class="row">
          <div class="col-5">
            <div class="about">
              <div class="logo">
                <img src="../image/logoyps.png" alt="">
                <a class="navbar-brand" href="#">Sistem Informasi Geografis <br>   Yayasan Nazhir Wakaf Pangeran Sumedang</a>
              </div>
              <p>Sistem informasi geografis berbasis web untuk digitalisasi peninggalan tanah wakaf pangerang sumedang merupakan sebuah situs web yang akan dimanfaatkan untuk peninjauan tanah wakaf yang dikelola oleh YNWPS</p>
            </div>
          </div>
          <div class="col-4 offset-2">
            <div class="company">
              <h4>Analisis Sebaran Tanah Wakaf</h4>
              <ul>
                <li>
                  <a href="<?= site_url('PolygonKecamatan/analisisLuas')?>">Analisis Luas Tanah</a>
                </li>
                <li>
                  <a href="<?= site_url('PolygonKecamatan/analisisjumlahTanah')?>">Analisis Jumlah Tanah</a>
                </li>
                <li>
                  <a href="<?= site_url('PolygonKecamatan/analisisPenggarap')?>">Analisis Jumlah Penggarap</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>