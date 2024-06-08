<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_item = $_POST['menu_item'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url']; // Optional field for image URL

    $query = "INSERT INTO menu (item, description, price, image_url) VALUES ('$menu_item', '$description', '$price', '$image_url')";
    if (mysqli_query($conn, $query)) {
        echo "Menu item updated successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu - KawaLeaves Cafe</title>
    <link rel="stylesheet" href="admin-style.css">
    <script src="admin-script.js" defer></script>
</head>

<body>
    <header>
        <h1>Update Menu</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Update Menu Items</h2>
        <form id="updateMenuForm" method="POST">
            <label for="menu_item">Menu Item:</label>
            <input type="text" id="menu_item" name="menu_item" required>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
            <label for="image_url">Image URL (optional):</label>
            <input type="text" id="image_url" name="image_url">
            <button type="submit">Update Menu</button>
        </form>
    </main>
</body>

</html>