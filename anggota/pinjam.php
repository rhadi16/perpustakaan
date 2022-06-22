<?php 
  $kode_agt = $_SESSION['kode_agt'];
  $qry2 = "SELECT
            b.kode_buku,
            b.judul,
            d.nama,
            a.tgl_pinjam,
            a.tgl_kembali,
            c.kode_agt,
            c.nama_agt,
            c.no_telp
          FROM tb_peminjaman a
          LEFT JOIN tb_buku b ON a.kode_buku = b.kode_buku
          LEFT JOIN tb_anggota c ON a.kode_agt = c.kode_agt
          LEFT JOIN admin d ON a.id_admin = d.id_admin
          WHERE a.kode_agt = '$kode_agt'";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Buku Yang Anda Pinjam</h5>
</div>

<div class="datatable">
  <table id="example" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Buku</th>
        <th>Petugas</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
      </tr>
    <tbody>
      <?php
        $no = 1;
        $query2 = mysqli_query($mysqli, $qry2);
        while ($data2 = mysqli_fetch_array($query2)) {
      ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data2['kode_buku'].' - '.$data2['judul'] ?></td>
            <td><?php echo $data2['nama'] ?></td>
            <td><?php echo datetimeFormat::TanggalIndo($data2['tgl_pinjam']); ?></td>
            <td><?php echo datetimeFormat::TanggalIndo($data2['tgl_kembali']); ?></td>
          </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>Kode Buku</th>
        <th>Judul</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
      </tr>
    </tfoot>
  </table>
</div>