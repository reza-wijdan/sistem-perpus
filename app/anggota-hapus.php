<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
		die;
	}
	
	include './config/koneksi-db.php';

	if(isset($_GET['id'])) { // memperoleh anggota_id
		$id_anggota = $_GET['id'];

		if(!empty($id_anggota)) {
			// Query
			$sql = "DELETE FROM anggota WHERE id_anggota = '{$id_anggota}';";
			$query = mysqli_query($db_conn, $sql);

			if(!$query) {
				echo "<script>alert('Data gagal dihapus!');</script>";
			}
		} else {
			echo "<script>alert('ID Anggota kosong!');</script>";
		}
	} else {
		echo "<script>alert('ID Anggota tidak didefinisikan!');</script>";		
	}

	// mengalihkan halaman
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=anggota'>";
?>