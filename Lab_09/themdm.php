<?php
require_once "db_module.php";

$message = "";
$link = null;

// Kết nối database
$link = taoKetNoi($link);
createTablesIfNotExist($link);

if ($_POST) {
    $ten_danhmuc = escapeString($link, $_POST['ten_danhmuc']);    
    if (!empty($ten_danhmuc)) {
        $sql = "INSERT INTO tbl_danhmuc (ten) VALUES ('$ten_danhmuc')";

        if (chayTruyVanKhongTraVeDL($link, $sql)) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $message = "<div class='alert error'>Lỗi khi thêm danh mục!</div>";
        }
    } else {
        $message = "<div class='alert error'>Tên danh mục không được để trống!</div>";
    }
}

// Hiển thị thông báo thành công từ URL parameter
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "<div class='alert success'>Thêm danh mục thành công!</div>";
}

giaiPhongBoNho($link, null);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Danh Mục</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .header h2 {
            font-size: 24px;
            font-weight: 300;
        }
        
        .content {
            padding: 30px;
        }
        
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid;
        }
        
        .alert.success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .alert.error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, textarea:focus {
            outline: none;
            border-color: #2c3e50;
        }
        
        textarea {
            resize: vertical;
            height: 100px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        
        button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #2c3e50;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #34495e;
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        
        .nav-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .nav-link a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
        }
        
        .nav-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thêm Danh Mục Mới</h2>
        </div>
        
        <div class="content">
            <?php echo $message; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ten_danhmuc">Tên danh mục *</label>
                    <input type="text" id="ten_danhmuc" name="ten_danhmuc" required>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn-primary">Thêm danh mục</button>
                    <button type="reset" class="btn-secondary">Nhập lại</button>
                </div>
            </form>
            
            <div class="nav-link">
                <a href="index.php">← Về trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>