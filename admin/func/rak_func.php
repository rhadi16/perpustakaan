<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$nama_rak 	= $_POST['nama_rak'];
		$lokasi_rak = $_POST['lokasi_rak'];

		$result = mysqli_query($mysqli, "INSERT INTO tb_rak (id_rak, nama_rak, lokasi_rak) 
										 VALUES(null, '$nama_rak', '$lokasi_rak')") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-in-rak" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-in-rak" </script>';
		}
		
	} elseif($action == "update") {

		$id_rak 	= $_POST['id_rak'];
		$nama_rak 	= $_POST['nama_rak'];
		$lokasi_rak = $_POST['lokasi_rak'];

		$result = mysqli_query($mysqli, "UPDATE tb_rak
			  									SET 
			  									   nama_rak	  = '$nama_rak',
			  									   lokasi_rak = '$lokasi_rak'
			  									   WHERE id_rak = '$id_rak'
			  									") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-rak" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-rak" </script>';
		}

	} elseif($action == "delete") {

		$id_rak = $_GET['id_rak'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_rak WHERE id_rak = '$id_rak'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-rak" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-rak" </script>';
		}

	}

?>