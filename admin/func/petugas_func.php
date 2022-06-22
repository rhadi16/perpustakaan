<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$email 		= $_POST['email'];
		$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
		$nama 		= $_POST['nama'];
		$jabatan 	= $_POST['jabatan'];
		$no_hp 		= $_POST['no_hp'];
		$alamat 	= $_POST['alamat'];

		$cek_data = mysqli_query($mysqli,"SELECT * FROM admin WHERE email = '$email'");
		$jum_data = mysqli_num_rows($cek_data);

		if ($jum_data >= 1) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-reg-ptg" </script>';
		} else {
			$result = mysqli_query($mysqli, "INSERT INTO admin (id_admin, email, password, nama, jabatan, no_hp, alamat) 
											VALUES(null, '$email', '$password', '$nama', '$jabatan', '$no_hp', '$alamat')") or die(mysqli_error($mysqli));

			if ($result) {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-reg-ptg" </script>';
			} else {
				echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-reg-ptg2" </script>';
			}
		}
		
	} elseif($action == "update") {

		$id_admin 	= $_POST['id_admin'];
		$email 		= $_POST['email'];
		$nama 		= $_POST['nama'];
		$jabatan 	= $_POST['jabatan'];
		$no_hp 		= $_POST['no_hp'];
		$alamat 	= $_POST['alamat'];
		if ($_POST['password'] == '') {
			$password  = $_POST['password_lama'];
		} else {
			$password 	= password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
		}

		$result = mysqli_query($mysqli, "UPDATE admin
			  									SET 
			  									   email 		= '$email',
			  									   password 	= '$password',
			  									   nama 		= '$nama',
			  									   jabatan 		= '$jabatan',
			  									   no_hp 		= '$no_hp',
			  									   alamat 		= '$alamat'
			  									   WHERE id_admin = '$id_admin'
			  									") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-ptg" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-ptg" </script>';
		}

	} elseif($action == "delete") {

		$id_admin = $_GET['id_admin'];

		$result = mysqli_query($mysqli, "DELETE FROM admin WHERE id_admin = '$id_admin'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-ptg" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-ptg" </script>';
		}

	}

?>