<?php
require_once __DIR__ . "/../controllers/themsp.php";
?>
<html>
<head>
    <title>Thêm Sản Phẩm</title>
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
            background-color: #27ae60;
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
        
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #27ae60;
        }
        
        textarea {
            resize: vertical;
            height: 100px;
        }
        
        select {
            cursor: pointer;
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
            background-color: #27ae60;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #229954;
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
            color: #27ae60;
            text-decoration: none;
            font-weight: 500;
        }
        
        .nav-link a:hover {
            text-decoration: underline;
        }
        
        .required {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thêm Sản Phẩm Mới</h2>
        </div>
        
        <div class="content">
            <?php echo $message; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ten_sanpham">Tên sản phẩm <span class="required">*</span></label>
                    <input type="text" id="ten_sanpham" name="ten_sanpham" required>
                </div>
                
                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <textarea id="mota" name="mota" placeholder="Nhập mô tả sản phẩm (tùy chọn)"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="gia">Giá <span class="required">*</span></label>
                    <input type="number" id="gia" name="gia" step="0.01" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="image">URL Hình ảnh</label>
                    <input type="text" id="image" name="image" placeholder="https://example.com/image.jpg">
                </div>
                
                <div class="form-group">
                    <label for="id_danhmuc">Danh mục <span class="required">*</span></label>
                    <select id="id_danhmuc" name="id_danhmuc" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach($danhmucs as $dm): ?>
                            <option value="<?php echo $dm['id']; ?>"><?php echo htmlspecialchars($dm['ten']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn-primary">Thêm sản phẩm</button>
                    <button type="reset" class="btn-secondary">Nhập lại</button>
                </div>
            </form>
            
            <div class="nav-link">
                <a href="../index.php">← Về trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>