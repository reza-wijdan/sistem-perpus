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
				<h3>Beranda</h3>	
			</div>
			<div class="page-content text-center">
				<h4>Selamat Datang di Sistem Informasi Perpustakaan!</h4>
				<p class="quote">&quot;Membaca adalah Jendela Dunia&quot;</p>
			</div>
		</div>
