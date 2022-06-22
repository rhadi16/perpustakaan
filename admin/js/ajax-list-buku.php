<?php include("../config/connect.php"); ?>

<?php
  $libook = mysqli_query($mysqli, "SELECT * FROM tb_buku");
  while ($dt_book = mysqli_fetch_array($libook)) {
?>
  <option value="<?php echo $dt_book['kode_buku'].' - '.$dt_book['judul'] ?>">
<?php } ?>