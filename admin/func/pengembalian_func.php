<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$id_peminjaman		= $_POST['id_peminjaman'];
		$tgl_pinjam			= $_POST['tgl_pinjam'];
		$tgl_kembali		= $_POST['tgl_kembali'];
		$tgl_dikembalikan	= $_POST['tgl_dikembalikan'];
		$denda				= $_POST['denda'];
		$kode_buku 			= explode(" - ", $_POST['kode_buku']);
		$kode_agt 			= explode(" - ", $_POST['kode_agt']);
		$id_admin 			= $_POST['id_admin'];

		$result = mysqli_query($mysqli, "INSERT INTO tb_pengembalian (id_pengembalian, tgl_pinjam, tgl_kembali, tgl_dikembalikan, denda, kode_buku, kode_agt, id_admin) 
										 VALUES(null, '$tgl_pinjam', '$tgl_kembali', '$tgl_dikembalikan', '$denda', '$kode_buku[0]', '$kode_agt[0]', '$id_admin')") or die(mysqli_error($mysqli));
		$result2 = mysqli_query($mysqli, "DELETE FROM tb_peminjaman WHERE id_peminjaman = '$id_peminjaman'") or die(mysqli_error($mysqli));

		if ($result && $result2) {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?desc=suc-in-kem&kode_agt='.$kode_agt[0].'" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?desc=fal-in-kem&kode_agt='.$kode_agt[0].'" </script>';
		}
		
	} elseif($action == "delete") {

		$id_pengembalian = $_GET['id_pengembalian'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_pengembalian WHERE id_pengembalian = '$id_pengembalian'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-kem" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-kem" </script>';
		}

	}

?>