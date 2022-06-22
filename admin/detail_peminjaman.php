<?php 
  session_start();
  include "config/connect.php";
  include('assets/datetime/datetimeFormat.php');

  if(!isset($_SESSION['id_admin'])){
    // fungsi redirect menggunakan javascript
    echo '<script language="javascript"> window.location.href = "../index.php" </script>';
  }

  $kode_agt = $_GET['kode_agt'];
?>
<?php 
  $qry3 = "SELECT 
            a.id_peminjaman,
            a.tgl_pinjam,
            a.tgl_kembali,
            a.kode_buku,
            b.judul,
            c.kode_agt,
            c.nama_agt
          FROM tb_peminjaman a
          LEFT JOIN tb_buku b ON a.kode_buku = b.kode_buku
          LEFT JOIN tb_anggota c ON a.kode_agt = c.kode_agt
          LEFT JOIN admin d ON a.id_admin = d.id_admin
          WHERE a.kode_agt = '$kode_agt'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Peminjaman</title>
  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- data tables -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
  <!-- BOX ICONS CSS-->
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
  <!-- custom css -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- sweetalert & jquery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="assets/sweetalert/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  <!-- Main Wrapper -->
  <div class="my-container">
    <!-- Top Nav -->
    <nav class="navbar top-navbar px-5 sticky-top">
      <a class="btn border-0" id="title"><h5>Perpustakaan Nasional</h5></a>
      <div class="info-admin">
        <a href="index.php" class="btn btn-primary df">Kembali</a>
      </div>
    </nav>
    
    <!-- Content -->
    <main>
      <div class="container">
        <div class="head-dt pb-2 mt-4">
          <?php 
          $agt = mysqli_query($mysqli, "SELECT * FROM tb_anggota WHERE kode_agt = '$kode_agt'");
          $agt1 = mysqli_fetch_array($agt);
        ?>
          <h5>Daftar Peminjaman Buku Milik <?php echo $agt1['nama_agt']; ?></h5>
        </div>

        <div class="datatable">
          <table id="example-detail" class="table table-striped align-middle text-center" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Judul</th>
                <th>Action</th>
              </tr>
            <tbody>
              <?php
                $no = 1;
                $query3 = mysqli_query($mysqli, $qry3);
                while ($data3 = mysqli_fetch_array($query3)) {
              ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo datetimeFormat::TanggalIndo($data3['tgl_pinjam']); ?></td>
                    <td><?php echo datetimeFormat::TanggalIndo($data3['tgl_kembali']); ?></td>
                    <td><?php echo $data3['judul'] ?></td>
                    <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dikembalikan<?php echo $data3['kode_buku']; ?>">Dikembalikan</button>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-pinjam<?php echo $data3['kode_buku']; ?>">Edit</button>
                      <button type="button" class="btn btn-danger conf-del-detpin<?php echo $data3['kode_agt']; ?>">Hapus</button>
                    </td>
                  </tr>

                  <script type="text/javascript">
                    $('.conf-del-detpin<?php echo $data3['kode_agt']; ?>').on('click', function(e) {
                      Swal.fire({
                        title: 'Anda Yakin?',
                        text: "Ingin Menghapus Pinjaman <?php echo $data3['judul']; ?>!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "<?php echo 'func/peminjaman_func.php?action=delete-all&kode_agt='.$data3['kode_agt'] ?>";
                        }
                      })
                    });
                  </script>

                  <!-- Modal Kembalikan Buku -->
                  <div class="modal fade" id="dikembalikan<?php echo $data3['kode_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pengembalian Buku</h5>
                        </div>
                        <form action="func/pengembalian_func.php?action=insert" enctype="multipart/form-data" method="post">
                          <div class="modal-body">
                            <input type="hidden" id="id_peminjaman" name="id_peminjaman" value="<?php echo $data3['id_peminjaman'] ?>">
                            <div class="mb-3">
                              <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                              <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required value="<?php echo $data3['tgl_pinjam'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <label for="tgl_kembali" class="form-label">Target Kembali</label>
                              <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required value="<?php echo $data3['tgl_kembali'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <label for="tgl_dikembalikan" class="form-label">Tanggal Kembalikan</label>
                              <input type="date" class="form-control" id="tgl_dikembalikan" name="tgl_dikembalikan" required value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <?php 
                                if (strtotime(date('Y-m-d')) <= strtotime($data3['tgl_kembali'])) {
                                  $denda = 0;
                                } else {
                                  $target = date_create($data3['tgl_kembali']);
                                  $dikembalikan = date_create();
                                  $diff = date_diff($target, $dikembalikan);

                                  $denda = $diff->days * 1000;
                                }
                                
                              ?>
                              <label for="denda" class="form-label">Denda</label>
                              <input type="text" class="form-control" id="denda" name="denda" required value="<?php echo $denda; ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <label for="kode_buku" class="form-label">Kode Buku</label>
                              <input class="form-control" list="list_book" id="kode_buku" name="kode_buku" required placeholder="Buku" value="<?php echo $data3['kode_buku'].' - '.$data3['judul'] ?>" readonly>
                              <datalist id="list_book">
                                <?php
                                  $libook = mysqli_query($mysqli, "SELECT * FROM tb_buku");
                                  while ($dt_book = mysqli_fetch_array($libook)) {
                                ?>
                                  <option value="<?php echo $dt_book['kode_buku'].' - '.$dt_book['judul'] ?>">
                                <?php } ?>
                              </datalist>
                            </div>
                            <div>
                              <label for="kode_agt" class="form-label">Kode Anggota</label>
                              <input class="form-control" list="list_agt" id="kode_agt" name="kode_agt" required placeholder="Anggota" value="<?php echo $data3['kode_agt'].' - '.$data3['nama_agt'] ?>" readonly>
                              <datalist id="list_agt">
                                <?php
                                  $liagt = mysqli_query($mysqli, "SELECT * FROM tb_anggota WHERE kode_agt = '$kode_agt'");
                                  while ($dt_agt = mysqli_fetch_array($liagt)) {
                                ?>
                                  <option value="<?php echo $dt_agt['kode_agt'].' - '.$dt_agt['judul'] ?>">
                                <?php } ?>
                              </datalist>
                            </div>
                            <input type="hidden" id="id_admin" name="id_admin" value="<?php echo $_SESSION['id_admin'] ?>">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Kembalikan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Edit Anggota -->
                  <div class="modal fade" id="edit-pinjam<?php echo $data3['kode_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Peminjaman Buku</h5>
                        </div>
                        <form action="func/peminjaman_func.php?action=update" enctype="multipart/form-data" method="post">
                          <div class="modal-body">
                            <input type="hidden" id="id_peminjaman" name="id_peminjaman" value="<?php echo $data3['id_peminjaman'] ?>">
                            <input type="hidden" id="id_admin" name="id_admin" value="<?php echo $_SESSION['user'] ?>">
                            <input type="hidden" id="kode_agt" name="kode_agt" value="<?php echo $kode_agt ?>">
                            <div class="mb-3">
                              <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                              <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required value="<?php echo $data3['tgl_pinjam'] ?>">
                            </div>
                            <div class="mb-3">
                              <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                              <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required value="<?php echo $data3['tgl_kembali'] ?>">
                            </div>
                            <div>
                              <label for="kode_buku" class="form-label">Kode Buku</label>
                              <input class="form-control" list="list_book" id="kode_buku" name="kode_buku" required placeholder="Buku" value="<?php echo $data3['kode_buku'].' - '.$data3['judul'] ?>">
                              <datalist id="list_book">
                                <?php
                                  $libook = mysqli_query($mysqli, "SELECT * FROM tb_buku");
                                  while ($dt_book = mysqli_fetch_array($libook)) {
                                ?>
                                  <option value="<?php echo $dt_book['kode_buku'].' - '.$dt_book['judul'] ?>">
                                <?php } ?>
                              </datalist>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Judul</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
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
        if ($desc == "suc-ed-pin") {
      ?>
        <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
      <?php } elseif ($desc == "suc-in-kem") { ?>
        <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
      <?php } elseif ($desc == "suc-del-agt") { ?>
        <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
      <?php } ?>
  <?php
    }
  ?>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- data tables -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <!-- My Script -->
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>