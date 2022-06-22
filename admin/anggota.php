<?php 
  $qry = "SELECT
            *
          FROM tb_anggota";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Anggota</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#tambah-anggota">Tambah Data Anggota</button>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="tambah-anggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Anggota Baru</h5>
      </div>
      <form action="func/anggota_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="kode_agt" name="kode_agt" required placeholder="Kode Anggota" value="<?php echo "AGT".rand(); ?>">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="nama_agt" name="nama_agt" required placeholder="Nama">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="email" placeholder="Input Email" required name="email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password" placeholder="Masukkan Password" required name="password">
          </div>
          <div class="mb-3">
            <select class="form-select form-control" aria-label="Default select example" required name="jkl_agt" id="jkl_agt">
              <option selected>Pilih Jenis Kelamin</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="no_telp" name="no_telp" required placeholder="Nomor HP/WA">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat">
          </div>
          <div>
            <input class="form-control" type="file" id="formFile" name="file_name" id="foto">
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
  <table id="example" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Anggota</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Nomor Hp/WA</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $query = mysqli_query($mysqli, $qry);
        while ($data = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['kode_agt'] ?></td>
            <td><?php echo $data['nama_agt'] ?></td>
            <td><?php echo $data['email'] ?></td>
            <td>
              <?php 
                if ($data['jkl_agt'] == "L") {
                  echo 'Laki-laki';
                 } else {
                  echo 'Perempuan';
                 }
              ?>
            </td>
            <td><?php echo $data['no_telp'] ?></td>
            <td><?php echo $data['alamat'] ?></td>
            <td><img src="foto_agt/<?php echo $data['foto'] ?>" class="img-thumbnail" alt="<?php echo $data['foto'] ?>"></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del-agt<?php echo $data['kode_agt']; ?>">Hapus</button>
              <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit-anggota<?php echo $data['kode_agt']; ?>">Edit</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-agt<?php echo $data['kode_agt']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Data <?php echo $data['nama_agt']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/anggota_func.php?action=delete&kode_agt='.$data['kode_agt'].'&foto='.$data['foto'] ?>";
                }
              })
            });
          </script>

          <!-- Modal Edit Anggota -->
          <div class="modal fade" id="edit-anggota<?php echo $data['kode_agt']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Anggota</h5>
                </div>
                <form action="func/anggota_func.php?action=update" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="kode_agt" name="kode_agt" required placeholder="Kode Anggota" value="<?php echo $data['kode_agt'] ?>">
                      <input type="hidden" name="kode_agt_lama" value="<?php echo $data['kode_agt'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="nama_agt" name="nama_agt" required placeholder="Nama" value="<?php echo $data['nama_agt'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="<?php echo $data['email'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="password_lama" value="<?php echo $data['password'] ?>">
                      <input type="password" class="form-control" name="password" placeholder="Password Baru">
                    </div>
                    <div class="mb-3">
                      <select class="form-select form-control" aria-label="Default select example" required name="jkl_agt" id="jkl_agt">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="L" <?php if($data['jkl_agt']=="L"){ echo 'selected';} ?>>Laki-laki</option>
                        <option value="P" <?php if($data['jkl_agt']=="P"){ echo 'selected';} ?>>Perempuan</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="no_telp" name="no_telp" required placeholder="Nomor HP/WA" value="<?php echo $data['no_telp'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat" value="<?php echo $data['alamat'] ?>">
                    </div>
                    <div>
                      <input class="form-control" type="file" id="formFile" name="file_name" id="foto">
                      <input type="hidden" name="file_name_sebelum" value="<?php echo $data['foto']; ?>">
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
        <th>Kode Anggota</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Nomor Hp/WA</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>