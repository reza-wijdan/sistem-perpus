<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION['id_admin'])) {
		echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
		die;
	}

	include '../config/koneksi-db.php';

	$sql = "SELECT * FROM buku ORDER BY id_buku DESC;";
	$query = mysqli_query($db_conn, $sql);
	$row = $query->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Daftar Buku</title>
	<style>
		* { margin: 0; font-family: Arial, Helvetica, sans-serif; }
		h3 { text-align: center; margin: 15px; text-decoration: underline; }
		section { margin: 0 auto; width: 960px; }
		table { border-collapse: collapse; }
		table, table th, table td { padding: 5px; border: 1px solid #CCC; }
		.text-center { text-align: center; }
	</style>
</head>
<body>
	<section>
	<?php
		if($row > 0) {
	?>
		<h3>Daftar Buku</h3>

		<table>
			<tr>
				<th width="30">No.</th>
				<th width="100">ID Buku</th>
				<th width="240">Nama Buku</th>
				<th width="150">Kategori Buku</th>
				<th width="150">Penulis</th>
				<th width="150">Penerbit</th>
				<th width="100">Status Ketersediaan</th>
			</tr>
		<?php
			$i = 1;
			while($data = mysqli_fetch_array($query)) {
		?>
					<tr>
				<td class="text-center"><?php echo $i++; ?></td>
				<td><?php echo $data['id_buku']; ?></td>
				<td><?php echo $data['judul_buku']; ?></td>
				<td><?php echo $data['id_kategori']; ?></td>
				<td><?php echo $data['id_penulis']; ?></td>
				<td><?php echo $data['id_penerbit']; ?></td>
				<td class="text-center"><?php echo ($data['status'] == 'Tersedia') ? 'Tersedia' : 'Dipinjam'; ?></td>
			</tr>
		<?php
			}
		?>
		</table>
	</section>
	<script type="text/javascript">
		window.print();
	</script>
	<?php
		}
	?>
</body>
</html>