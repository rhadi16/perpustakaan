<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$tgl_pinjam		= $_POST['tgl_pinjam'];
		$tgl_kembali	= $_POST['tgl_kembali'];
		$kode_buku 		= $_POST['kode_buku'];
		$kode_agt 		= explode(" - ", $_POST['kode_agt']);
		$id_admin 		= $_POST['id_admin'];

		$jum_data = count($kode_buku);

		for ($i=0; $i < $jum_data; $i++) { 
			$pisah_kode_buku[$i] = explode(" - ", $kode_buku[$i]);

			$kd_buku[$i] = $pisah_kode_buku[$i][0];

			$result = mysqli_query($mysqli, "INSERT INTO tb_peminjaman (id_peminjaman, tgl_pinjam, tgl_kembali, kode_buku, kode_agt, id_admin) 
											 VALUES(null, '$tgl_pinjam', '$tgl_kembali', '$kd_buku[$i]', '$kode_agt[0]', '$id_admin')") or die(mysqli_error($mysqli));
		}


		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-in-pin" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-in-pin" </script>';
		}
		
	} elseif($action == "update") {

		$id_peminjaman	= $_POST['id_peminjaman'];
		$tgl_pinjam		= $_POST['tgl_pinjam'];
		$tgl_kembali	= $_POST['tgl_kembali'];
		$kode_buku 		= explode(" - ", $_POST['kode_buku']);
		$id_admin 		= $_POST['id_admin'];
		$kode_agt 		= $_POST['kode_agt'];

		$result = mysqli_query($mysqli, "UPDATE tb_peminjaman
			  									SET 
			  									   tgl_pinjam	= '$tgl_pinjam',
			  									   tgl_kembali	= '$tgl_kembali',
			  									   kode_buku	= '$kode_buku[0]',
			  									   id_admin		= '$id_admin'
			  									   WHERE id_peminjaman = '$id_peminjaman'
			  									") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?kode_agt='.$kode_agt.'&desc=suc-ed-pin" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?desc=fal-ed-detpin&kode_agt='.$kode_agt.'" </script>';
		}

	} elseif($action == "delete-all") {

		$kode_agt = $_GET['kode_agt'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_peminjaman WHERE kode_agt = '$kode_agt'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-pin" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-pin" </script>';
		}

	} elseif($action == "delete-one") {

		$id_peminjaman = $_GET['id_peminjaman'];
		$kode_agt 	   = $_GET['kode_agt'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_peminjaman WHERE id_peminjaman = '$id_peminjaman'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?desc=suc-del-pinbook&kode_agt='.$kode_agt.'" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../detail_peminjaman.php?desc=fal-del-pinbook" </script>';
		}

	}

?>