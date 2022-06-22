<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$kode_buku 	= $_POST['kode_buku'];
		$judul 		= $_POST['judul'];
		$penulis 	= $_POST['penulis'];
		$penerbit 	= $_POST['penerbit'];
		$thn_terbit = $_POST['thn_terbit'];
		$stok 		= $_POST['stok'];
		$id_rak 	= explode(" - ", $_POST['id_rak']);

		$result = mysqli_query($mysqli, "INSERT INTO tb_buku (kode_buku, judul, penulis, penerbit, thn_terbit, stok, id_rak) 
										 VALUES('$kode_buku', '$judul', '$penulis', '$penerbit', '$thn_terbit', '$stok', '$id_rak[0]')") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-in-book" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-in-book" </script>';
		}
		
	} elseif($action == "update") {

		$kode_buku_lama	= $_POST['kode_buku_lama'];
		$kode_buku 		= $_POST['kode_buku'];
		$judul 			= $_POST['judul'];
		$penulis 		= $_POST['penulis'];
		$penerbit 		= $_POST['penerbit'];
		$thn_terbit 	= $_POST['thn_terbit'];
		$stok 			= $_POST['stok'];
		$id_rak 		= explode(" - ", $_POST['id_rak']);

		$result = mysqli_query($mysqli, "UPDATE tb_buku
			  									SET 
			  									   kode_buku	= '$kode_buku',
			  									   judul		= '$judul',
			  									   penulis		= '$penulis',
			  									   penerbit		= '$penerbit',
			  									   thn_terbit	= '$thn_terbit',
			  									   stok			= '$stok',
			  									   id_rak		= '$id_rak[0]'
			  									   WHERE kode_buku = '$kode_buku_lama'
			  									") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-book" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-book" </script>';
		}

	} elseif($action == "delete") {

		$kode_buku = $_GET['kode_buku'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_buku WHERE kode_buku = '$kode_buku'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-book" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-book" </script>';
		}

	}

?>