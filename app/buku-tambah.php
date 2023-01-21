<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
		die;
	}

	include './config/koneksi-db.php';

	/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
	if(!isset($_POST['simpan'])) {
		/* Mempersiapkan ID Anggota Baru */
		$sql = "SELECT id_buku FROM buku;";
		$query = mysqli_query($db_conn, $sql);
		$row = $query->num_rows;

		$id_buku_tmp = $row + 1; // Menambahkan +1 untuk ID Anggota Baru
		$id_buku_tmp = str_pad($id_buku_tmp, 3, "0", STR_PAD_LEFT); // Menambahkan "0" sampai panjang 3 digit termasuk ID Anggota Baru
		$id_buku_tmp = 'BK' . $id_buku_tmp;

		/* Mempersiapkan ID Anggota Baru */
		$sql_kategori = "SELECT id_kategori FROM kategori;";
		$query_kategori = mysqli_query($db_conn, $sql_kategori);
		$row_kategori = $query_kategori->num_rows;

		$sql_penulis = "SELECT id_penulis FROM penulis;";
		$query_penulis = mysqli_query($db_conn, $sql_penulis);
		$row_penulis = $query_penulis->num_rows;

		$sql_penerbit = "SELECT id_penerbit FROM penerbit;";
		$query_penerbit = mysqli_query($db_conn, $sql_penerbit);
		$row_penerbit = $query_penerbit->num_rows;

?>

		<div id="container">
			<div class="page-title">
				<h3>Tambah Data Buku</h3>	
			</div>
			<div class="page-content">
				<form action="" method="post" >
					<table class="form-table">
						<tr>
							<td>
								<label for="id_buku">ID Buku</label>
							</td>
							<td>					
								<input type="text" name="id_buku" id="id_buku" value="<?php echo $id_buku_tmp; ?>" readonly>
							</td>
						</tr>
						<tr>
							<td>
								<label for="judul_buku">Nama Buku</label>
							</td>
							<td>								
								<input type="text" name="judul_buku" id="judul_buku" required>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id_kategori">ID Kategori</label>
							</td>
							<td>								
								<select name="id_kategori" id="id_kategori" required>
							<?php
								while($data = mysqli_fetch_array($query_kategori)) {
							?>
								<option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['id_kategori'] ?>
									
											
									</option>		
								
							<?php
								}
							?>				
									
								</select>

							</td>
						</tr>
						<tr>
							<td>
								<label for="id_penulis">ID Penulis</label>
							</td>
							<td>																
								<select name="id_penulis" id="id_penulis" required>

								<?php
									while($data = mysqli_fetch_array($query_penulis)) {
								?>
									<option value="<?php echo $data['id_penulis'] ?>"><?php echo $data['id_penulis'] ?></option>		
								
								<?php
									}
								?>				
									
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="id_penerbit">ID Penerbit</label>
							</td>
							<td>								
								<select name="id_penerbit" id="id_penerbit" required>

								<?php
									while($data = mysqli_fetch_array($query_penerbit)) {
								?>
									<option value="<?php echo $data['id_penerbit'] ?>"><?php echo $data['id_penerbit'] ?></option>		
								
								<?php
									}
								?>				
									
								</select>
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
		$status	= 'Tersedia';

		

		 //Query
		$sql = "INSERT INTO buku 
				VALUES('{$id_buku}', '{$judul_buku}', '{$id_kategori}', 
					 '{$id_penulis}', '{$id_penerbit}', '{$status}')";
		$query = mysqli_query($db_conn, $sql);

		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=buku'>";
		
	}

?>