<!doctype html>
<html lang="en">

<head>
  <title>Sistem Informasi Geografis YPS</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="http://localhost/tugasakhir/public/material_dashboard/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <?= $this->renderSection('head') ?>
</head>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CT
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
        </a>
      </div>
      
      <div class="sidebar-wrapper" id="sidebar">
        <ul class="nav">
          <!-- your sidebar here -->
          <li class="nav-item active">
            <a class="nav-link" href="<?= site_url('Tanah/polygonsumedang')?>">
              <i class="material-icons">maps</i>
              <p>Analisis Jumlah Tanah</p>
            </a>
          </li>
          <li class ="nav-item">
            <a class="nav-link" href="">
              <i class="material-icons">south</i>
              <p>DALAM PENGEMBANGAN</p>
            </a>
            <a class="nav-link" href="<?= site_url('PolygonKecamatan/polygonsumedang')?>">
              <i class="material-icons">maps</i>
              <p>Analisis Luas Tanah </p>
            </a>
            <a class="nav-link" href="<?= site_url('Wakaf/polygonsumedang')?>">
              <i class="material-icons">maps</i>
              <p>Analisis Jumlah Penggarap </p>
            </a>
            <a class="nav-link" href="<?= site_url('Wakaf/formmarker')?>">
              <i class="material-icons">maps</i>
              <p>Create Marker</p>
            </a>
            <a class="nav-link" href="<?= site_url('PolygonKecamatan/formpolygon')?>">
              <i class="material-icons">maps</i>
              <p>Create Polygon</p>
            </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" >
                <i class="material-icons">face</i>
                <p>Admin Action</p>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?= site_url('Tanah/formpolygon')?>"><i class="material-icons">hexagon</i>Form Polygon</a></li>
                <li><a class="dropdown-item" href="<?= site_url('Tanah/formmarker')?>"><i class="material-icons">location_on</i>Form Marker</a></li>
                <!-- <li><a class="dropdown-item" href="<?= site_url('Tanah/polygontanahwakaf')?>">Polygon Kecamatan</a></li> -->
                <li><a class="dropdown-item" href="<?= site_url('Tanah/index')?>"><i class="material-icons">terrain</i>Data Tanah Wakaf</a></li>
                <li><a class="dropdown-item" href="<?= site_url('Kecamatan/index')?>"><i class="material-icons">location_city</i>Data Kecamatan</a></li>
                <li><a class="dropdown-item" href="<?= site_url('Nadzir/index')?>"><i class="material-icons">manage_account</i>Data Nadzir</a></li>
                <li><a class="dropdown-item" href=""><i class="material-icons">south</i>DALAM PENGEMBANGAN</a></li>
                <li><a class="dropdown-item" href="<?= site_url('Wakaf/index')?>"><i class="material-icons">manage_account</i>Data Wakaf</a></li>
                <li><a class="dropdown-item" href="<?= site_url('PolygonKecamatan/index')?>"><i class="material-icons">manage_account</i>Data Polygon</a></li>
                <!-- <li><a class="dropdown-item" href="<?= site_url('Tanah/index')?>">Data Tanah Wakaf</a></li> -->
                
              </ul>
           </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">notifications</i> Notifications
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <?= $this->renderSection('content') ?>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
  <script src="http://localhost/tugasakhir/public/material_dashboard/assets/js/core/jquery.min.js"></script>
  <script src="http://localhost/tugasakhir/public/material_dashboard/assets/js/core/popper.min.js"></script>
  <script src="http://localhost/tugasakhir/public/material_dashboard/assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="http://localhost/tugasakhir/public/material_dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- <script type='text/javascript'>
  $(".nav>li").each(function() {
      var navItem = $(this);
      if (navItem.find("a").attr("href") == location.pathname) {
        navItem.addClass("active");
      }
  });
</script> -->
  <?= $this->renderSection('script') ?>
</body>

</html>