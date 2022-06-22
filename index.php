<?php 
  session_start();
  include "admin/config/connect.php";

  if(isset($_SESSION['id_admin'])){
    // fungsi redirect menggunakan javascript
    echo '<script language="javascript"> window.location.href = "admin" </script>';
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- BOX ICONS CSS-->
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
  <!-- custom css -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <!-- Main Wrapper -->
  <div class="my-container">
    <!-- Top Nav -->
    <nav class="navbar top-navbar px-5">
      <a class="btn border-0" id="title"><h5>Perpustakaan Nasional</h5></a>
      <div class="info">
        <i class='bx bxs-info-circle'></i>
      </div>
    </nav>
    <!--End Top Nav -->
    
    <!-- Content -->
    <main>
      <div class="container">
        <form method="post" action="login_func.php">
          <div class="form">
            <img src="img/perpus.png" class="logo-login mb-3">
            <div class="mb-3">
              <input type="email" class="form-control" id="email" placeholder="Email" required name="email">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="Password" required name="password">
              <!-- <p>Belum Punya Akun? <a href="registrasi.php">Registrasi</a></p> -->
            </div>
            <div class="mb-5">
              <select class="form-select form-control" aria-label="Default select example" name="level">
                <option value="admin">Admin</option>
                <option value="anggota">Anggota</option>
              </select>
            </div>
            <button type="submit" class="btn btn-danger login">LOGIN</button>
            <!-- <button type="button" class="btn btn-danger" id="btn-clear-cache">clear chace</button> -->
          </div>
        </form>
      </div>

      <!-- <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class="bi bi-exclamation-triangle"></i>
            <strong class="me-auto">Attention!</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Chace Terhapus
          </div>
        </div>
      </div> -->
    </main>
  </div>

  <?php
    if (isset($_GET['desc'])) {
      $desc = $_GET['desc']; 
  ?>
      <?php
        if ($desc == "failed-log") {
      ?>
        <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
      <?php } elseif ($desc == "failed-log2") { ?>
        <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
      <?php } ?>
  <?php
    }
  ?>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="admin/assets/sweetalert/dist/sweetalert2.all.min.js"></script>
  <!-- My Script -->
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>