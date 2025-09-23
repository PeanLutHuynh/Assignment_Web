<?php
require_once "db_module.php";

$link = null;
$danhmucs = [];
$sanphams = [];
$selected_category = null;

// Kết nối database
$link = taoKetNoi($link);
createTablesIfNotExist($link);

// Lấy danh sách danh mục
$sql_dm = "SELECT id, ten FROM tbl_danhmuc ORDER BY ten";
$result_dm = chayTruyVanTraVeDL($link, $sql_dm);
if ($result_dm) {
    while ($row = mysqli_fetch_assoc($result_dm)) {
        $danhmucs[] = $row;
    }
}

// Lấy sản phẩm theo danh mục nếu có
if (isset($_GET['category'])) {
    $category_id = (int)$_GET['category'];
    
    // Lấy thông tin danh mục
    $sql_cat = "SELECT ten FROM tbl_danhmuc WHERE id = $category_id";
    $result_cat = chayTruyVanTraVeDL($link, $sql_cat);
    if ($result_cat && mysqli_num_rows($result_cat) > 0) {
        $selected_category = mysqli_fetch_assoc($result_cat);
    }
    
    // Lấy sản phẩm theo danh mục
    $sql_sp = "SELECT * FROM tbl_sanpham WHERE id_dm = $category_id ORDER BY ten";
    $result_sp = chayTruyVanTraVeDL($link, $sql_sp);
    if ($result_sp) {
        while ($row = mysqli_fetch_assoc($result_sp)) {
            $sanphams[] = $row;
        }
    }
}

giaiPhongBoNho($link, null);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hàng hóa - Lab 09</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 300;
        }
        
        .nav-actions {
            display: flex;
            gap: 15px;
        }
        
        .nav-actions a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .nav-actions a:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }
        
        .sidebar {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: fit-content;
        }
        
        .sidebar h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 500;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar li {
            margin-bottom: 8px;
        }
        
        .sidebar a {
            display: block;
            padding: 12px 16px;
            color: #555;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .sidebar a:hover {
            background-color: #ecf0f1;
            color: #2c3e50;
        }
        
        .sidebar a.active {
            background-color: #2c3e50;
            color: white;
        }
        
        .main-content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .welcome {
            text-align: center;
            padding: 40px 20px;
        }
        
        .welcome h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 300;
            font-size: 32px;
        }
        
        .welcome p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .category-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
        }
        
        .category-header h2 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 400;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            border: 1px solid #ecf0f1;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .product-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .product-name {
            font-size: 18px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .product-desc {
            color: #7f8c8d;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: 600;
            color: #27ae60;
        }
        
        .no-products {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-actions {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Quản lý hàng hóa</h1>
            <div class="nav-actions">
                <a href="themdm.php">Thêm danh mục</a>
                <a href="themsp.php">Thêm sản phẩm</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <h3>Danh mục sản phẩm</h3>
            <ul>
                <li><a href="index.php" <?php echo !isset($_GET['category']) ? 'class="active"' : ''; ?>>Tất cả</a></li>
                <?php foreach($danhmucs as $dm): ?>
                    <li>
                        <a href="?category=<?php echo $dm['id']; ?>" 
                           <?php echo (isset($_GET['category']) && $_GET['category'] == $dm['id']) ? 'class="active"' : ''; ?>>
                            <?php echo htmlspecialchars($dm['ten']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="main-content">
            <?php if (!isset($_GET['category'])): ?>
                <div class="welcome">
                    <h2>Chào mừng đến với hệ thống quản lý hàng hóa</h2>
                    <p>Chọn danh mục từ menu bên trái để xem sản phẩm hoặc sử dụng các chức năng thêm mới ở phía trên.</p>
                </div>
            <?php else: ?>
                <?php if ($selected_category): ?>
                    <div class="category-header">
                        <h2>Danh mục: <?php echo htmlspecialchars($selected_category['ten']); ?></h2>
                    </div>
                    
                    <?php if (count($sanphams) > 0): ?>
                        <div class="product-grid">
                            <?php foreach($sanphams as $sp): ?>
                                <div class="product-card">
                                    <div class="product-name"><?php echo htmlspecialchars($sp['ten']); ?></div>
                                    <div class="product-desc"><?php echo htmlspecialchars($sp['mota']); ?></div>
                                    <div class="product-price"><?php echo number_format($sp['gia'], 0, ',', '.'); ?> VNĐ</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-products">
                            <p>Chưa có sản phẩm nào trong danh mục này.</p>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="no-products">
                        <p>Không tìm thấy danh mục.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>