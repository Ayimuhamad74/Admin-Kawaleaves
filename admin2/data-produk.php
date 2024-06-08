<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="Width-device-width, initial-scale=1">
	<title>Produk | KawaLeaves</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family-Quicksand">
</head>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">KawaLeaves</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<!-- <li><a href="profil.php">Profile admin</a></li> -->
				<li><a href="data-produk.php">Produk & Menu Tersedia</a></li>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
		<script src="https://unpkg.com/feather-icons"></script>
	</header>
	<!-- Content -->
	<div class="section">
		<div class="container">
			<h3>Data Produk</h3>
			<div class="box">
				<p><a href="tambah-produk.php"><img src="produk/add.png" width="50px"></a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Nama Produk</th>
							<th width="100px">Harga</th>
							<th>Deskripsi</th>
							<th>Gambar</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_id");
						if (mysqli_num_rows($produk) > 0) {
							while ($row = mysqli_fetch_array($produk)) {
								?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $row['product_name'] ?></td>
									<td>Rp. <?php echo number_format($row['product_price']) ?></td>
									<td><?php echo $row['product_description'] ?></td>
									<td><img src="produk/<?php echo $row['product_image'] ?>" width="50px"></td>
									<td><?php echo ($row['product_status'] == 0) ? 'Not ready now' : 'Ready' ?></td>
									<td>
										<a href="edit-produk.php?idep=<?php echo $row['product_id'] ?>">Edit</a> || <a
											href="proses-hapus.php?idhp=<?php echo $row['product_id'] ?>"
											onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="7">Tidak Ada Produk</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!--Footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy 2024 - KawaLeaves</small>
		</div>
	</footer>
</body>

</html>