<?php
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);
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
            <h1><a href="index.php">KawaLeaves</a></h1>
            <ul>
                <li><a href="profile-perusahaan.php">Profile Perusahaan</a></li>
            </ul>
        </div>
    </header>
    <!--detail produk-->
    <div class="section">
        <div class="container">
            Tentang Produk
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda."
                            target="_blank">
                            Hubungin via Whatsapp <br>
                            <img src="img/wa.png" width="50px"></a>
                    </p>
                </div>
            </div>
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