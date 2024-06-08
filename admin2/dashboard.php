<?php
include 'db.php';
session_start();
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="Width-device-width, initial-scale=1">
	<title>KawaLeaves</title>
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
				<li><a href="data-produk.php">Data Produk & Menu</a></li>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>
	<!-- Content -->
	<div class="section">
		<div class="container">
			<h3>Dashboard Admin</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di KawaLeaves</h4>
			</div>
		</div>
	</div>

	<!--produk-->
	<div class="section">
		<div class="container">
			<h3>Produk & Menu Tersedia</h3>
			<div class="box">
				<?php
				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC");
				if (mysqli_num_rows($produk) > 0) {
					while ($p = mysqli_fetch_array($produk)) {
						?>
						<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
							<div class="col-1">
								<img src="produk/<?php echo $p['product_image'] ?>">
								<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
								<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>

		<!--Footer-->
		<div class="footer">
			<div class="container">
				<h4>Alamat</h4>
				<p><?php echo $a->admin_address ?></p>

				<h4>Email</h4>
				<p><?php echo $a->admin_email ?></p>

				<h4>No. HP</h4>
				<p><?php echo $a->admin_telp ?></p>
				<small>Copyright &copy; 2024 - KawaLeaves.</small>
			</div>
		</div>
</body>

</html>