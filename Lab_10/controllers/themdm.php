<?php
require_once __DIR__ . '/../models/danhmuc.php';

class DanhmucController {
    private $danhMucModel;
    private $message;
    
    public function __construct() {
        $this->danhMucModel = new Danhmuc();
        $this->message = "";
        
        // Tạo bảng nếu chưa tồn tại
        $link = taoKetNoi(null);
        createTablesIfNotExist($link);
        giaiPhongBoNho($link, null);
    }
    
    public function add() {
        if ($_POST) {
            $ten_danhmuc = trim($_POST['ten_danhmuc']);
            
            if (!empty($ten_danhmuc)) {
                $this->danhMucModel->setTen($ten_danhmuc);
                
                if ($this->danhMucModel->save()) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit();
                } else {
                    $this->message = "<div class='alert error'>Lỗi khi thêm danh mục!</div>";
                }
            } else {
                $this->message = "<div class='alert error'>Tên danh mục không được để trống!</div>";
            }
        }
        
        // Hiển thị thông báo thành công từ URL parameter
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            $this->message = "<div class='alert success'>Thêm danh mục thành công!</div>";
        }
        
        return $this->message;
    }
}

// Khởi tạo controller và xử lý
$controller = new DanhmucController();
$message = $controller->add();
?>