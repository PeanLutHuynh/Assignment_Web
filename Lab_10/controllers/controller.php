<?php
require_once __DIR__ . '/../models/danhmuc.php';
require_once __DIR__ . '/../models/hanghoa.php';
require_once __DIR__ . '/../modules/config.php';

class MainController {
    private $danhMucModel;
    private $hangHoaModel;
    
    public function __construct() {
        $this->danhMucModel = new Danhmuc();
        $this->hangHoaModel = new HangHoa();
        
        // Tạo bảng nếu chưa tồn tại
        $link = taoKetNoi(null);
        createTablesIfNotExist($link);
        giaiPhongBoNho($link, null);
    }
    
    public function index() {
        $danhmucs = $this->danhMucModel->getAll();
        $sanphams = [];
        $selected_category = null;
        
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $category_id = (int)$_GET['category'];
            $selected_category = $this->danhMucModel->getById($category_id);
            $sanphams = $this->hangHoaModel->getByCategory($category_id);
        } else {
            // Mặc định hiển thị tất cả sản phẩm
            $sanphams = $this->hangHoaModel->getAll();
        }
        
        return [
            'danhmucs' => $danhmucs,
            'sanphams' => $sanphams,
            'selected_category' => $selected_category
        ];
    }
    
    public function viewProduct($id) {
        $product = $this->hangHoaModel->getById($id);
        return $product;
    }
}
?>