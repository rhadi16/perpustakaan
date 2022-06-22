<?php 
  $id_adm = $_SESSION['id_admin'];
  $qry = "SELECT
            *
          FROM admin WHERE id_admin != $id_adm";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Petugas</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#tambah-anggota">Tambah Data Petugas</button>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="tambah-anggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Petugas Baru</h5>
      </div>
      <form action="func/petugas_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="email" class="form-control" id="email" placeholder="Input Email" required name="email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password" placeholder="Masukkan Password" required name="password">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="nama" placeholder="Nama Admin" required name="nama">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" required name="jabatan">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="no_hp" placeholder="Nomor HP/WA" required name="no_hp">
          </div>
          <div>
            <input type="text" class="form-control" id="alamat" placeholder="Alamat" required name="alamat">
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
  <table id="example11" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Email</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Nomor Hp/WA</th>
        <th>Alamat</th>
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
            <td><?php echo $data['email'] ?></td>
            <td><?php echo $data['nama'] ?></td>
            <td><?php echo $data['jabatan'] ?></td>
            <td><?php echo $data['no_hp'] ?></td>
            <td><?php echo $data['alamat'] ?></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del-ptg<?php echo $data['id_admin']; ?>">Hapus</button>
              <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit-petugas<?php echo $data['id_admin']; ?>">Edit</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-ptg<?php echo $data['id_admin']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Data <?php echo $data['nama']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/petugas_func.php?action=delete&id_admin='.$data['id_admin'] ?>";
                }
              })
            });
          </script>

          <!-- Modal Edit petugas -->
          <div class="modal fade" id="edit-petugas<?php echo $data['id_admin']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Petugas</h5>
                </div>
                <form action="func/petugas_func.php?action=update" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <div class="mb-3">
                      <input type="hidden" name="id_admin" value="<?php echo $data['id_admin'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="<?php echo $data['email'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="password_lama" value="<?php echo $data['password'] ?>">
                      <input type="password" class="form-control" name="password" placeholder="Password Baru">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama" value="<?php echo $data['nama'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="Jabatan" value="<?php echo $data['jabatan'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Nomor HP/WA" value="<?php echo $data['no_hp'] ?>">
                    </div>
                    <div>
                      <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat" value="<?php echo $data['alamat'] ?>">
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
        <th>Email</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Nomor Hp/WA</th>
        <th>Alamat</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>