<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
		die;
	}
	
	include './config/koneksi-db.php';

	if(!isset($_POST['simpan'])) {
		if(isset($_GET['id'])) { // memperoleh anggota_id
			$id_buku = $_GET['id'];

			if(!empty($id_buku)) {
				// Query
				$sql = "SELECT * FROM buku WHERE id_buku = '{$id_buku}';";
				$query = mysqli_query($db_conn, $sql);
				$row = $query->num_rows;

				if($row > 0) {
					$data = mysqli_fetch_array($query); // memperoleh data anggota

					// echo '<pre>';
					// var_dump($data);
					// echo '</pre>';
				} else {
					echo "<script>alert('ID Buku tidak ditemukan!');</script>";

					// mengalihkan halaman
					echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
					exit;
				}
			} else {
				echo "<script>alert('ID Buku kosong!');</script>";

				// mengalihkan halaman
				echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
				exit;
			}
		} else {
			echo "<script>alert('ID Buku tidak didefinisikan!');</script>";

			// mengalihkan halaman
			echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
			exit;
		}
?>

		<div id="container">
			<div class="page-title">
				<h3>Tambah Data Buku</h3>	
			</div>
			<div class="page-content">
				<form action="" method="post" enctype="multipart/form-data">
					<table class="form-table">
						<tr>
							<td>
								<label for="id_buku">ID Buku</label>
							</td>
							<td>					
								<input type="text" name="id_buku" id="id_buku" value="<?php echo $data['id_buku']; ?>" readonly>
							</td>
						</tr>
						<tr>
							<td>
								<label for="judul_buku">Judul Buku</label>
							</td>
							<td>								
								<input type="text" name="judul_buku" id="judul_buku" value="<?php echo $data['judul_buku']; ?>" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id_kategori">Kategori Buku</label>
							</td>
							<td>								
								<input type="text" name="id_kategori" id="id_kategori" value="<?php echo $data['id_kategori']; ?>" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id_penulis">Penulis Buku</label>
							</td>
							<td>								
								<input type="text" name="id_penulis" id="id_penulis" value="<?php echo $data['id_penulis']; ?>" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id_penerbit">Penerbit Buku</label>
							</td>
							<td>								
								<input type="text" name="id_penerbit" id="id_penerbit" value="<?php echo $data['id_penerbit']; ?>" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Status Ketersediaan</label>
							</td>
							<td>								
								<input type="radio" name="status" value="Tersedia" id="status_true" <?php echo ($data['status'] == 'T') ? 'checked' : ''; ?> required>
								<label for="status_true">Tersedia</label>

								<input type="radio" name="status" value="Dipinjam" id="status_false" <?php echo ($data['status'] == 'D') ? 'checked' : ''; ?> required>
								<label for="status_false">Dipinjam</label>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;
							</td>
							<td>								
								<input type="submit" name="simpan" value="Simpan">
							</td>
						</tr>						
					</table>
				</form>
			</div>
		</div>

<?php 
	} else { 
		/* Proses Penyimpanan Data dari Form */

		$id_buku 		= $_POST['id_buku'];
		$judul_buku 	= $_POST['judul_buku'];
		$id_kategori	= $_POST['id_kategori'];
		$id_penulis		= $_POST['id_penulis'];
		$id_penerbit	= $_POST['id_penerbit'];
		//$file_foto 		= $_FILES['buku']['name'];
		$status			= $_POST['status'];


		if(!empty($file_foto)) {
			// Rename file foto. Contoh: foto-AG007.jpg
			$ext_file = pathinfo($file_foto, PATHINFO_EXTENSION);
			$file_foto_rename = 'foto-' . $id_buku . '.' . $ext_file;

			$dir_images = './images/';
			$path_image = $dir_images . $file_foto_rename;
			$file_foto = $file_foto_rename; // untuk keperluan Query UPDATE

			// Jika file foto sudah tersedia
			if(file_exists($path_image)) {
				unlink($path_image); // file foto dihapus
			}

			move_uploaded_file($_FILES['foto']['tmp_name'], $path_image);
		} //else {
			//$file_foto = $file_foto_tmp; // jika tidak diubah gunakan yang sudah ada sebelumnya
		//}

		$sql = "UPDATE buku 
					SET judul_buku 		= '{$judul_buku}',
						id_kategori 	= '{$id_kategori}',
						id_penulis 		= '{$id_penulis}',
						id_penerbit		= '{$id_penerbit}', 
						status			= '{$status}'
					WHERE id_buku		='{$id_buku}'";
		$query = mysqli_query($db_conn, $sql);
		
		if(!$query) {
			echo "<script>alert('Data gagal diubah!');</script>";
		}

		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
	}
?>