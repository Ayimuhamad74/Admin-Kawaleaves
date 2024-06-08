<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['idep'] . "' ");
if (mysqli_num_rows($produk) == 0) {
	echo '<script>window.location="data-produk.php"</script>';
}
$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="Width-device-width, initial-scale=1">
	<title>Edit Produk | KawaLeaves</title>
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
				<li><a href="data-produk.php">Produk & Menu Tersedia</a></li>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>
	<!-- Content -->
	<div class="section">
		<div class="container">
			<h3>Edit Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk"
						value="<?php echo $p->product_name ?>" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga Produk"
						value="<?php echo $p->product_price ?>" required>
					<img src="produk/<?php echo $p->product_image ?>" width="100px">
					<input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
					<input type="file" name="gambar" class="input-control">
					<textarea name="deskripsi" class="input-control"
						placeholder="Deskripsi Produk"><?php echo $p->product_description ?></textarea><br>
					<select name="status" class="input-control">
						<option value="">Status Produk</option>
						<option value="1" <?Php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Ready</option>
						<option value="0" <?Php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Not ready now
						</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					$nama = $_POST['nama'];
					$harga = $_POST['harga'];
					$deskripsi = $_POST['deskripsi'];
					$status = $_POST['status'];
					$foto = $_POST['foto'];

					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					if ($filename != '') {
						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk' . time() . '.' . $type2;

						$tipe_file = array('jpg', 'jpeg', 'png', 'gif');

						if (!in_array($type2, $tipe_file)) {
							echo '<script>alert("Format file tidak diizinkan")</scrtip>';

						} else {
							unlink('./produk/' . $foto);
							move_uploaded_file($tmp_name, './produk/' . $newname);
							$namagambar = $newname;
						}

					} else {
						$namagambar = $foto;

					}

					$update = $foto;

					$update = mysqli_query($conn, "UPDATE tb_product SET
                        product_name        = '" . $nama . "',
                        product_price       = '" . $harga . "',
                        product_description = '" . $deskripsi . "',
                        product_image       = '" . $namagambar . "',
                        product_status      = '" . $status . "'
                        WHERE product_id    = '" . $p->product_id . "' ");

					if ($update) {
						echo '<script>window.location="data-produk.php"</script>';
					} else {
						echo 'Gagal memperbarui data' . mysqli_error($conn);
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

</html>