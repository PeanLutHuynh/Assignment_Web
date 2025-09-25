<?php
require_once __DIR__ . '/../models/hanghoa.php';
require_once __DIR__ . '/../models/danhmuc.php';

class HanghoaController {
    private $hangHoaModel;
    private $danhMucModel;
    private $message;
    
    public function __construct() {
        $this->hangHoaModel = new HangHoa();
        $this->danhMucModel = new Danhmuc();
        $this->message = "";
        
        // Tạo bảng nếu chưa tồn tại
        $link = taoKetNoi(null);
        createTablesIfNotExist($link);
        giaiPhongBoNho($link, null);
    }
    
    public function add() {
        if ($_POST) {
            $ten_sanpham = trim($_POST['ten_sanpham']);
            $mota = trim($_POST['mota']);
            $gia = floatval($_POST['gia']);
            $id_danhmuc = intval($_POST['id_danhmuc']);
            $image = isset($_POST['image']) ? trim($_POST['image']) : '';
            
            if (!empty($ten_sanpham) && $gia >= 0 && $id_danhmuc > 0) {
                $this->hangHoaModel->setTen($ten_sanpham);
                $this->hangHoaModel->setMota($mota);
                $this->hangHoaModel->setGia($gia);
                $this->hangHoaModel->setIdDm($id_danhmuc);
                $this->hangHoaModel->setImage($image);
                
                if ($this->hangHoaModel->save()) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit();
                } else {
                    $this->message = "<div class='alert error'>Lỗi khi thêm sản phẩm!</div>";
                }
            } else {
                $this->message = "<div class='alert error'>Vui lòng điền đầy đủ thông tin!</div>";
            }
        }
        
        // Hiển thị thông báo thành công từ URL parameter
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            $this->message = "<div class='alert success'>Thêm sản phẩm thành công!</div>";
        }
        
        return [
            'message' => $this->message,
            'danhmucs' => $this->danhMucModel->getAll()
        ];
    }
}

// Khởi tạo controller và xử lý
$controller = new HanghoaController();
$data = $controller->add();
$message = $data['message'];
$danhmucs = $data['danhmucs'];
?>