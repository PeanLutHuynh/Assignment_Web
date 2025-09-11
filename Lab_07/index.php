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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS - Load sau Bootstrap để override -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="container" class="container-fluid">
        <div id="banner" class="text-center">
            <h1 class="display-4 fw-bold">CỬA HÀNG ĐIỆN TỬ CÔNG NGHỆ</h1>
        </div>
        <div id="menu" class="navbar navbar-expand-lg">
            <?php foreach(array_keys($data) as $category): ?>
                <a href="?gr=<?php echo $category; ?>" 
                   class="menu_item btn btn-outline-light me-2 <?php echo ($current_category == $category) ? 'active' : ''; ?>">
                    <?php echo $category; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div id="lmenu" class="col-md-3">
                <h3 style="margin-top:0; color:#333;" class="h5">MENU SẢN PHẨM</h3>
                <?php include "lmenu.php"; ?>
            </div>
            <div id="content" class="col-md-9">
                <h3 style="margin-top:0; color:#333;" class="h5">DANH SÁCH SẢN PHẨM</h3>
                <?php include "content.php"; ?>
            </div>
        </div>
        <div id="footer" class="text-center mt-4 py-3">
            <p class="mb-0">© 2025 Cửa hàng điện tử công nghệ. Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM | Hotline: 0123.456.789</p>
        </div>
    </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>