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
	<title>Tambah Produk | KawaLeaves</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family-Quicksand">
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">KawaLeaves</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profile admin</a></li>
				<!-- <li><a href="data-produk.php">Data Produk</a></li> -->
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>
	<!-- Content -->
	<div class="section">
		<div class="container">
			<h3>Tambah Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga Produk" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea name="deskripsi" class="input-control" placeholder="Deskripsi Produk"></textarea><br>
					<select name="status" class="input-control">
						<option value="">Status Produk</option>
						<option value="1">Ready</option>
						<option value="0">Not ready now</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {
					$nama = $_POST['nama'];
					$harga = $_POST['harga'];
					$deskripsi = $_POST['deskripsi'];
					$status = $_POST['status'];

					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];
					$newname = 'produk' . time() . '.' . $type2;

					$tipe_file = array('jpg', 'jpeg', 'png', 'gif');

					if (!in_array($type2, $tipe_file)) {
						echo '<Script>alert("Format file tidak diizinkan")</Script>';
					} else {
						move_uploaded_file($tmp_name, './produk/' . $newname);

						$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
							null,
							'" . $nama . "',
							'" . $harga . "',
							'" . $deskripsi . "',
							'" . $newname . "',
							'" . $status . "',
							null) ");

						if ($insert) {
							echo '<script>window.location="data-produk.php"</script>';
						} else {
							echo 'Gagal menyimpan data' . mysqli_error($conn);
						}
					}
				}
				?>
			</div>
		</div>
	</div>
	</div>

	<!--Footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy 2024 - KawaLeaves</small>
		</div>
	</footer>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
	<script>
	</script>
</body>
</body>

</html>