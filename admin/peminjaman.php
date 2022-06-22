<?php 
  $qry3 = "SELECT DISTINCT
            c.kode_agt,
            c.nama_agt,
            c.no_telp
          FROM tb_peminjaman a
          LEFT JOIN tb_buku b ON a.kode_buku = b.kode_buku
          LEFT JOIN tb_anggota c ON a.kode_agt = c.kode_agt
          LEFT JOIN admin d ON a.id_admin = d.id_admin";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Peminjaman Buku</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#pinjam-buku">Tambah Peminjaman Buku</button>
</div>

<!-- Modal Tambah peminjaman -->
<div class="modal fade" id="pinjam-buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Peminjaman Buku Baru</h5>
      </div>
      <form action="func/peminjaman_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
          </div>
          <div class="mb-3">
            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
          </div>
          <div class="mb-1">
            <label for="kode_buku" class="form-label">Buku yang Dipinjam <button type="button" id="tambah-kolom" class="btn btn-primary">+ Tambah Buku</button></label>
            <div class="element" id="div_1">
              <div id="txt_1">
                <input class="form-control mb-2" list="list_kode_buku" id="kode_buku" name="kode_buku[]" required placeholder="Judul Buku">
                <datalist id="list_kode_buku">
                  <?php
                    $libook = mysqli_query($mysqli, "SELECT * FROM tb_buku");
                    while ($dt_book = mysqli_fetch_array($libook)) {
                  ?>
                    <option value="<?php echo $dt_book['kode_buku'].' - '.$dt_book['judul'] ?>">
                  <?php } ?>
                </datalist>
              </div>
            </div>
          </div>
          <div>
            <label for="kode_agt" class="form-label">Nama Anggota</label>
            <input class="form-control" list="list_kode_agt" id="kode_agt" name="kode_agt" required placeholder="Nama Anggota">
            <datalist id="list_kode_agt">
              <?php
                $liagt = mysqli_query($mysqli, "SELECT * FROM tb_anggota");
                while ($dt_agt = mysqli_fetch_array($liagt)) {
              ?>
                <option value="<?php echo $dt_agt['kode_agt'].' - '.$dt_agt['nama_agt'] ?>">
              <?php } ?>
            </datalist>
          </div>
          <input type="hidden" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>">
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
  <table id="example3" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Anggota</th>
        <th>Nama Anggota</th>
        <th>Nomor HP/WA</th>
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
            <td><?php echo $data3['kode_agt'] ?></td>
            <td><?php echo $data3['nama_agt'] ?></td>
            <td><?php echo $data3['no_telp'] ?></td>
            <td>
              <a href="detail_peminjaman.php?kode_agt=<?php echo $data3['kode_agt'] ?>" class="btn btn-primary mb-1">Lihat Detail</a>
              <button type="button" class="btn btn-danger mb-1 conf-del-pinjam<?php echo $data3['kode_agt']; ?>">Hapus</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-pinjam<?php echo $data3['kode_agt']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Pinjaman <?php echo $data3['nama_agt']; ?>!",
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

      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>Kode Anggota</th>
        <th>Nama Anggota</th>
        <th>Nomor HP/WA</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>