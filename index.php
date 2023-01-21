<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		exit;
	}
	include './config/konfigurasi-umum.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard | Sistem Informasi Perpustakaan</title>
		<link rel="stylesheet" href="./assets/css/style.css">
	</head>
	<body>
		<div id="wrapper">
			<?php include './app/layout/header.php'?>
			<?php include './app/layout/sidebar-menu.php' ?>
			
			<?php
				/* Menentukkan halaman berdasarkan menu yang dipilih */
				$app_dir = 'app';
				$p = ''; // variable untuk menentukkan halaman yang dituju
				if(isset($_GET['p'])) { // memeriksa variable
					$p = $_GET['p'];
				}
				
				/* Lakukan include file *.php sesuai halaman yang dituju */
				if(!empty($p)) {
					$file = $app_dir . '/' . $p . '.php';
					if(file_exists($file)) { // memeriksa apakah file *.php tersedia?
						include $file;
					} else {
						include $app_dir . '/404.php';
					}
				} else {
					include $app_dir . '/Beranda.php';
				}
			?>
			<?php include './app/layout/footer.php' ?>
			
		</div>
		<script src="./assets/js/app.js"></script>
	</body>
</html>