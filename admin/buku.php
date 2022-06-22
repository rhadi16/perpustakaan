<?php 
  $qry2 = "SELECT
            *
          FROM tb_buku a 
          LEFT JOIN tb_rak b ON a.id_rak = b.id_rak";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Buku</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#tambah-buku">Tambah Buku</button>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="tambah-buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Buku Baru</h5>
      </div>
      <form action="func/buku_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" required placeholder="Kode Buku" value="<?php echo "BOOK".rand(); ?>">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="judul" name="judul" required placeholder="Judul Buku">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="penulis" name="penulis" required placeholder="Penulis Buku">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="penerbit" name="penerbit" required placeholder="Penerbit Buku">
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="thn_terbit" name="thn_terbit" required placeholder="Tahun Terbit">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="stok" name="stok" required placeholder="Stok Buku">
          </div>
          <div>
            <input class="form-control" list="list_rak" id="id_rak" name="id_rak" required placeholder="Rak Buku">
            <datalist id="list_rak">
              <?php
                $lirak = mysqli_query($mysqli, "SELECT * FROM tb_rak");
                while ($dt_rak = mysqli_fetch_array($lirak)) {
              ?>
                <option value="<?php echo $dt_rak['id_rak'].' - '.$dt_rak['nama_rak'] ?>">
              <?php } ?>
            </datalist>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="datatable">
  <table id="example2" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Buku</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Stok</th>
        <th>Nama Rak</th>
        <th>Lokasi Rak</th>
        <th>Action</th>
      </tr>
    <tbody>
      <?php
        $no = 1;
        $query2 = mysqli_query($mysqli, $qry2);
        while ($data2 = mysqli_fetch_array($query2)) {
      ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data2['kode_buku'] ?></td>
            <td><?php echo $data2['judul'] ?></td>
            <td><?php echo $data2['penulis'] ?></td>
            <td><?php echo $data2['penerbit'].', '.$data2['thn_terbit'] ?></td>
            <td><?php echo $data2['stok'] ?></td>
            <td><?php echo $data2['nama_rak'] ?></td>
            <td><?php echo $data2['lokasi_rak'] ?></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del-buku<?php echo $data2['kode_buku']; ?>">Hapus</button>
              <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit-buku<?php echo $data2['kode_buku']; ?>">Edit</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-buku<?php echo $data2['kode_buku']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Buku <?php echo $data2['judul']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/buku_func.php?action=delete&kode_buku='.$data2['kode_buku'] ?>";
                }
              })
            });
          </script>

          <!-- Modal Edit Anggota -->
          <div class="modal fade" id="edit-buku<?php echo $data2['kode_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Buku</h5>
                </div>
                <form action="func/buku_func.php?action=update" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <input type="hidden" id="kode_buku_lama" name="kode_buku_lama" value="<?php echo $data2['kode_buku'] ?>">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="kode_buku" name="kode_buku" required placeholder="Kode Buku" value="<?php echo $data2['kode_buku'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="judul" name="judul" required placeholder="Judul Buku" value="<?php echo $data2['judul'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="penulis" name="penulis" required placeholder="Penulis Buku" value="<?php echo $data2['penulis'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="penerbit" name="penerbit" required placeholder="Penerbit Buku" value="<?php echo $data2['penerbit'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="number" class="form-control" id="thn_terbit" name="thn_terbit" required placeholder="Tahun Terbit" value="<?php echo $data2['thn_terbit'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="stok" name="stok" required placeholder="Stok Buku" value="<?php echo $data2['stok'] ?>">
                    </div>
                    <div>
                      <input class="form-control" list="list_rak" id="id_rak" name="id_rak" required placeholder="Rak Buku" value="<?php echo $data2['id_rak'].' - '.$data2['nama_rak'] ?>">
                      <datalist id="list_rak">
                        <?php
                          $lirak = mysqli_query($mysqli, "SELECT * FROM tb_rak");
                          while ($dt_rak = mysqli_fetch_array($lirak)) {
                        ?>
                          <option value="<?php echo $dt_rak['id_rak'].' - '.$dt_rak['nama_rak'] ?>">
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
        <th>Kode Buku</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Stok</th>
        <th>Nama Rak</th>
        <th>Lokasi Rak</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>