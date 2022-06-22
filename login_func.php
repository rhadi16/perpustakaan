<?php 
	include 'admin/config/connect.php';
	session_start();

	$level = $_POST['level'];
	$email = $_POST['email'];

	if ($level == 'admin') {

		// $cek_data = mysqli_query($mysqli,"SELECT * FROM admin WHERE email = '$email'");
		$query = "SELECT * FROM admin WHERE email = '$email'";
		$result = $mysqli->query($query);
		$cek_data = $result->fetch_assoc();
		// $jum_data = mysqli_num_rows($cek_data);

		$cek_pass = password_verify($_POST['password'], $cek_data["password"]);

		if ($cek_pass) {
			$_SESSION['id_admin'] = $cek_data["id_admin"];

			echo '<script language="javascript"> window.location.href = "admin/index.php" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "index.php?desc=failed-log" </script>';
		}

	} elseif ($level == 'anggota') {

		// $cek_data = mysqli_query($mysqli,"SELECT * FROM admin WHERE email = '$email'");
		$query = "SELECT * FROM tb_anggota WHERE email = '$email'";
		$result = $mysqli->query($query);
		$cek_data = $result->fetch_assoc();
		// $jum_data = mysqli_num_rows($cek_data);

		$cek_pass = password_verify($_POST['password'], $cek_data["password"]);

		if ($cek_pass) {
			$_SESSION['kode_agt'] = $cek_data["kode_agt"];

			echo '<script language="javascript"> window.location.href = "anggota/index.php" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "index.php?desc=failed-log" </script>';
		}

	} else {
		echo '<script language="javascript"> window.location.href = "index.php?desc=failed-log2" </script>';
	}
	
	
?>