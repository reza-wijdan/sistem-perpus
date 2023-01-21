<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
		die;
	}

?>
		<div id="container">
			<div class="page-title">
				<h3>Error 404</h3>	
			</div>
			<div class="page-content text-center">
				<h4>Halaman Tidak Ditemukan!</h4>
				<p>Ups! Halaman yang anda cari tidak ditemukan</p>
			</div>
		</div>
