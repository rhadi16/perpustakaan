<?php 
  $qry5 = "SELECT
            *
          FROM tb_rak";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Rak</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#tambah-rak">Tambah Rak</button>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="tambah-rak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Rak Baru</h5>
      </div>
      <form action="func/rak_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="nama_rak" name="nama_rak" required placeholder="Nama Rak">
          </div>
          <div>
            <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak" required placeholder="Lokasi Rak">
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
  <table id="example5" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Rak</th>
        <th>Lokasi Rak</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $query5 = mysqli_query($mysqli, $qry5);
        while ($data5 = mysqli_fetch_array($query5)) {
        ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data5['nama_rak'] ?></td>
            <td><?php echo $data5['lokasi_rak'] ?></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del-rak<?php echo $data5['id_rak']; ?>">Hapus</button>
              <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit-rak<?php echo $data5['id_rak']; ?>">Edit</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-rak<?php echo $data5['id_rak']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Rak <?php echo $data5['nama_rak']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/rak_func.php?action=delete&id_rak='.$data5['id_rak'] ?>";
                }
              })
            });
          </script>

          <!-- Modal Edit Anggota -->
          <div class="modal fade" id="edit-rak<?php echo $data5['id_rak']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Rak</h5>
                </div>
                <form action="func/rak_func.php?action=update" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <input type="hidden" id="id_rak" name="id_rak" value="<?php echo $data5['id_rak'] ?>">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="nama_rak" name="nama_rak" required placeholder="Nama Rak" value="<?php echo $data5['nama_rak'] ?>">
                    </div>
                    <div>
                      <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak" required placeholder="Lokasi Rak" value="<?php echo $data5['lokasi_rak'] ?>">
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
        <th>Nama Rak</th>
        <th>Lokasi Rak</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>