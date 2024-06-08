<?php
    include 'db.php';
    if(isset($_GET['idhp'])) {
        $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idhp']."' ");
        $p = mysqli_fetch_object($produk);
        
        unlink('./produk/'.$p->product_image);
        
        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idhp']."' ");
        echo '<script>window.location="data-produk.php"</script>';
    }
?>