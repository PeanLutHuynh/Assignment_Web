<?php
require_once "data.php";
$current_category = isset($_GET['gr']) ? $_GET['gr'] : 'Laptop';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng điện tử công nghệ</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="container">
        <div id="banner">
            <h1>CỬA HÀNG ĐIỆN TỬ CÔNG NGHỆ</h1>
        </div>
        <div id="menu">
            <?php foreach(array_keys($data) as $category): ?>
                <a href="?gr=<?php echo $category; ?>" 
                   class="menu_item <?php echo ($current_category == $category) ? 'active' : ''; ?>">
                    <?php echo $category; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div id="lmenu">
            <h3 style="margin-top:0; color:#333;">MENU SẢN PHẨM</h3>
            <?php include "lmenu.php"; ?>
        </div>
        <div id="content">
            <h3 style="margin-top:0; color:#333;">DANH SÁCH SẢN PHẨM</h3>
            <?php include "content.php"; ?>
        </div>
        <br style="clear:both;">
        <div id="footer">
            <p>© 2025 Cửa hàng điện tử công nghệ. Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM | Hotline: 0123.456.789</p>
        </div>
    </div>
</body>
</html>