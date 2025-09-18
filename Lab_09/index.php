<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hanghoa";
?>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Hàng hóa</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
        }
        .sidebar h3 {
            margin-top: 0;
            color: #333;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin: 10px 0;
        }
        .sidebar a {
            text-decoration: none;
            color: #007bff;
            padding: 8px 12px;
            display: block;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h3>Danh mục sản phẩm</h3>
            <ul>
                <?php
                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "SELECT * FROM tbl_danhmuc ORDER BY ten";
                    $stmt = $pdo->query($sql);
                    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li><a href='?category=" . $row['id'] . "'>" . htmlspecialchars($row['ten']) . "</a></li>";
                    }
                } catch(PDOException $e) {
                    echo "<li>Lỗi kết nối database: " . $e->getMessage() . "</li>";
                }
                ?>
            </ul>
        </div>
        
        <div class="content">
            <h1>Chào mừng đến với cửa hàng</h1>
            <p>Chọn danh mục từ menu bên trái để xem sản phẩm.</p>
            
            <?php
            if(isset($_GET['category'])) {
                $category_id = (int)$_GET['category'];
                echo "<h2>Sản phẩm theo danh mục</h2>";
                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "SELECT ten FROM tbl_danhmuc WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $category_id);
                    $stmt->execute();
                    
                    $category = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($category) {
                        echo "<p>Hiển thị sản phẩm cho danh mục: " . htmlspecialchars($category['ten']) . "</p>";
                    } else {
                        echo "<p>Không tìm thấy danh mục</p>";
                    }
                } catch(PDOException $e) {
                    echo "<p>Lỗi: " . $e->getMessage() . "</p>";
                }
                echo "<ul>";
                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "SELECT * FROM tbl_sanpham WHERE id_dm = :id_dm";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id_dm', $category_id);
                    $stmt->execute();
                    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>" . htmlspecialchars($row['ten']) . " - " . htmlspecialchars($row['mota']) . " - " . htmlspecialchars($row['gia']) . " VNĐ</li>";
                    }
                } catch(PDOException $e) {
                    echo "<li>Lỗi kết nối database: " . $e->getMessage() . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</body>
</html>