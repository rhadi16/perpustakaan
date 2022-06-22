<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$kode_agt = $_POST['kode_agt'];
		$nama_agt = $_POST['nama_agt'];
		$email 	  = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
		$jkl_agt  = $_POST['jkl_agt'];
		$no_telp  = $_POST['no_telp'];
		$alamat   = $_POST['alamat'];
		// Ambil Data yang Dikirim dari Form
		$nama_file = $_FILES['file_name']['name'];
		$tmp_file  = $_FILES['file_name']['tmp_name'];

		$foto = rand().$nama_file;

		// Set path folder tempat menyimpan gambarnya
		$path = "../foto_agt/".$foto;

		if (move_uploaded_file($tmp_file, $path)) {
			$result = mysqli_query($mysqli, "INSERT INTO tb_anggota (kode_agt, nama_agt, email, password, jkl_agt, no_telp, alamat, foto) 
											 VALUES('$kode_agt', '$nama_agt', '$email', '$password', '$jkl_agt', '$no_telp', '$alamat', '$foto')") or die(mysqli_error($mysqli));

			if ($result) {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-in-agt" </script>';
			} else {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-in-agt" </script>';
			}
		}
		
	} elseif($action == "update") {

		$kode_agt_lama	= $_POST['kode_agt_lama'];
		$kode_agt 		= $_POST['kode_agt'];
		$nama_agt 		= $_POST['nama_agt'];
		$email 			= $_POST['email'];
		$jkl_agt  		= $_POST['jkl_agt'];
		$no_telp  		= $_POST['no_telp'];
		$alamat   		= $_POST['alamat'];
		$file_name_sebelum = $_POST['file_name_sebelum'];
		// Ambil Data yang Dikirim dari Form
		$nama_file = $_FILES['file_name']['name'];
		$tmp_file  = $_FILES['file_name']['tmp_name'];

		if ($_POST['password'] == '') {
			$password  = $_POST['password_lama'];
		} else {
			$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
		}

		$foto = rand().$nama_file;

		// Set path folder tempat menyimpan gambarnya
		$path = "../foto_agt/".$foto;

		if (move_uploaded_file($tmp_file, $path)) {
			$result = mysqli_query($mysqli, "UPDATE tb_anggota
				  									SET 
				  									   kode_agt = '$kode_agt',
				  									   nama_agt = '$nama_agt',
				  									   email 	= '$email',
				  									   password = '$password',
				  									   jkl_agt 	= '$jkl_agt',
				  									   no_telp 	= '$no_telp',
				  									   alamat   = '$alamat',
				  									   foto    	= '$foto'
				  									   WHERE kode_agt = '$kode_agt_lama'
				  									") or die(mysqli_error($mysqli));

			if ($result) {
				$hapus_foto = unlink("../foto_agt/".$file_name_sebelum);
				echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-agt" </script>';
			} else {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-agt" </script>';
			}
		} else {
			$result = mysqli_query($mysqli, "UPDATE tb_anggota
				  									SET 
				  									   kode_agt = '$kode_agt',
				  									   nama_agt = '$nama_agt',
				  									   email 	= '$email',
				  									   password = '$password',
				  									   jkl_agt 	= '$jkl_agt',
				  									   no_telp 	= '$no_telp',
				  									   alamat   = '$alamat',
				  									   foto    	= '$file_name_sebelum'
				  									   WHERE kode_agt = '$kode_agt_lama'
				  									") or die(mysqli_error($mysqli));

			if ($result) {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-agt" </script>';
			} else {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-agt" </script>';
			}
		}

	} elseif($action == "delete") {

		$kode_agt = $_GET['kode_agt'];
		$foto 	  = $_GET['foto'];

		$result = mysqli_query($mysqli, "DELETE FROM tb_anggota WHERE kode_agt = '$kode_agt'") or die(mysqli_error($mysqli));

		if ($result) {
			$hapus_foto = unlink("../foto_agt/".$foto);
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-agt" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-agt" </script>';
		}

	}

?>