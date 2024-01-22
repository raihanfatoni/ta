<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Login.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    
    <title>Login</title>
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
              <a class="nav-link " aria-current="page" href=<?= base_url("home/index"); ?>>Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=<?= base_url("polygonkecamatan/analisisLuas"); ?> >Pemetaan Tanah Wakaf</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Login -->
    <div class="login">
      <div class="right">
        <img src="../image/Login.png" width="800px" height="500px"alt="">
      </div>
      <div class="left">
        <div class="header">
          <h2>Hallo Admin</h2>
          <h4>Daftarkan admin baru dengan mengisi form di bawah ini</h4>
      </div>
      <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->get('success'); ?>
            </div>
    <?php endif; ?>
      <form class="form"action="/login/register" method="post">
          <div class="form-item">
              <label for="InputEmail"><p>Email</p></label><br>
              <input type="text" name="email" id="email" class="form-field animation a3"  placeholder="Masukan Email Anda" value="<?= set_value('email'); ?>">
          </div>
          <div class="form-item">
              <label for="InputPassword"><p>Kata Sandi</p></label><br>
              <input type="password" class="form-field animation a4" placeholder="Masukan Kata Sandi Anda" name="password" id="password" value=""><br>
          </div>
          <div class="form-item">
              <label for="InputPassword"><p>Konfirmasi Kata Sandi</p></label><br>
              <input type="password" class="form-field animation a4" placeholder="Konfirmasi Ulang Kata Sandi" name="password_confirm" id="password_confirm" value=""><br>
          </div>
          <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors(); ?>
                    </div>
            </div>
            <?php endif; ?>
          <div class="button">
            <button type="submit" class="btn active">Register</button><br>
            <a class="btn passive" href=<?= base_url("dashboard") ?>>Pemetaan Tanah Wakaf</a>
          </div>
      </form>
      </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>