<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['ten']); ?> - Chi tiết sản phẩm</title>
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
            padding: 30px 20px;
        }
        
        .product-detail {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        
        .product-image-section {
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        
        .product-image-large {
            width: 100%;
            max-width: 400px;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .product-image-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info-section {
            padding: 30px;
        }
        
        .product-title {
            font-size: 32px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .product-price-large {
            font-size: 36px;
            font-weight: 700;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .product-category-badge {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 25px;
        }
        
        .product-description {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 30px;
        }
        
        .product-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        
        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .product-image-large {
                height: 300px;
            }
            
            .product-title {
                font-size: 24px;
            }
            
            .product-price-large {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Chi tiết sản phẩm</h1>
            <!-- <div class="nav-actions">
                <a href="index.php">← Về trang chủ</a>
            </div> -->
        </div>
    </div>

    <div class="container">
        <?php if ($product): ?>
            <div class="product-detail">
                <div class="product-image-section">
                    <div class="product-image-large">
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['ten']); ?>"
                                 onerror="this.src='https://via.placeholder.com/400x400?text=No+Image'">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x400?text=No+Image" 
                                 alt="<?php echo htmlspecialchars($product['ten']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="product-info-section">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['ten']); ?></h1>
                    
                    <div class="product-price-large">
                        <?php echo number_format($product['gia'], 0, ',', '.'); ?> VNĐ
                    </div>
                    
                    <div class="product-category-badge">
                        <?php echo htmlspecialchars($product['ten_danhmuc']); ?>
                    </div>
                    
                    <div class="product-description">
                        <?php echo nl2br(htmlspecialchars($product['mota'])); ?>
                    </div>
                    
                    <div class="product-actions">
                        <a href="index.php?category=<?php echo $product['id_dm']; ?>" class="btn btn-primary">
                            Xem sản phẩm cùng danh mục
                        </a>
                        <a href="index.php" class="btn btn-secondary">
                            Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <h2>Không tìm thấy sản phẩm</h2>
                <p><a href="index.php">← Về trang chủ</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>