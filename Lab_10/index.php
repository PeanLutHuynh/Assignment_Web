<?php
require_once "controllers/controller.php";

// Khởi tạo controller và lấy dữ liệu
$controller = new MainController();

// Xử lý view chi tiết sản phẩm
if (isset($_GET['product']) && !empty($_GET['product'])) {
    $product = $controller->viewProduct((int)$_GET['product']);
    if ($product) {
        include "views/product_detail.php";
        exit;
    }
}

// Xử lý trang chủ
$data = $controller->index();
$danhmucs = $data['danhmucs'];
$sanphams = $data['sanphams'];
$selected_category = $data['selected_category'];
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hàng hóa</title>
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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            border: 1px solid #ecf0f1;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            cursor: pointer;
        }
        
        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateY(-3px);
        }
        
        .product-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-info {
            padding: 15px;
            text-align: center;
        }
        
        .product-name {
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.4;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .product-card-link:hover .product-name {
            color: #3498db;
        }
        
        .product-desc {
            color: #7f8c8d;
            margin-bottom: 15px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: #27ae60;
            margin-bottom: 10px;
        }
        
        .product-category {
            font-size: 14px;
            color: #95a5a6;
            font-style: italic;
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
                <a href="views/themdm.php">Thêm danh mục</a>
                <a href="views/themsp.php">Thêm sản phẩm</a>
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
            <?php if ($selected_category): ?>
                <div class="category-header">
                    <h2>Danh mục: <?php echo htmlspecialchars($selected_category['ten']); ?></h2>
                </div>
            <?php else: ?>
                <div class="category-header">
                    <h2>Tất cả sản phẩm</h2>
                </div>
            <?php endif; ?>
            
            <?php if (count($sanphams) > 0): ?>
                <div class="product-grid">
                    <?php foreach($sanphams as $sp): ?>
                        <a href="?product=<?php echo $sp['id']; ?>" class="product-card-link">
                            <div class="product-card">
                                <div class="product-image">
                                    <?php if (!empty($sp['image'])): ?>
                                        <img src="<?php echo htmlspecialchars($sp['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($sp['ten']); ?>"
                                             onerror="this.src='https://via.placeholder.com/280x180?text=No+Image'">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/280x180?text=<?php echo urlencode($sp['ten']); ?>" 
                                             alt="<?php echo htmlspecialchars($sp['ten']); ?>">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-info">
                                    <div class="product-name">
                                        <?php echo htmlspecialchars($sp['ten']); ?>
                                    </div>
                                    <div class="product-price"><?php echo number_format($sp['gia'], 0, ',', '.'); ?> VNĐ</div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-products">
                    <p>Chưa có sản phẩm nào<?php echo $selected_category ? ' trong danh mục này' : ''; ?>.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>