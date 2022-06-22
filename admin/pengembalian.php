<?php 
  $qry4 = "SELECT 
             a.id_pengembalian,
             a.tgl_pinjam,
             a.tgl_kembali,
             a.tgl_dikembalikan,
             a.denda,
             a.kode_buku,
             b.judul,
             c.kode_agt,
             c.nama_agt
           FROM tb_pengembalian a
           LEFT JOIN tb_buku b ON a.kode_buku = b.kode_buku
           LEFT JOIN tb_anggota c ON a.kode_agt = c.kode_agt
           LEFT JOIN admin d ON a.id_admin = d.id_admin";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Buku Dikembalikan</h5>
</div>

<div class="datatable">
  <table id="example4" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Anggota</th>
        <th>Kode Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal DiKembalikan</th>
        <th>Denda</th>
        <th>Action</th>
      </tr>
    <tbody>
      <?php
        $no = 1;
        $query4 = mysqli_query($mysqli, $qry4);
        while ($data4 = mysqli_fetch_array($query4)) {
      ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data4['kode_agt'].' - '.$data4['nama_agt'] ?></td>
            <td><?php echo $data4['kode_buku'].' - '.$data4['judul'] ?></td>
            <td><?php echo datetimeFormat::TanggalIndo($data4['tgl_pinjam']); ?></td>
            <td><?php echo datetimeFormat::TanggalIndo($data4['tgl_dikembalikan']); ?></td>
            <td>Rp. <?php echo number_format($data4['denda'],0,",",".") ?></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del-kembali<?php echo $data4['id_pengembalian']; ?>">Hapus</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del-kembali<?php echo $data4['id_pengembalian']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Data Pengembalian <?php echo $data4['judul']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/pengembalian_func.php?action=delete&id_pengembalian='.$data4['id_pengembalian'] ?>";
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
        <th>Kode Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal DiKembalikan</th>
        <th>Denda</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>