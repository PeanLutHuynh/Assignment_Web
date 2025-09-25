<?php
require_once __DIR__ . '/../modules/db_module.php';

class HangHoa {
    private $id;
    private $ten;
    private $mota;
    private $gia;
    private $id_dm;
    private $image;
    private $link;

    public function getId() { return $this->id; }
    public function getTen() { return $this->ten; }
    public function getMota() { return $this->mota; }
    public function getGia() { return $this->gia; }
    public function getIdDm() { return $this->id_dm; }
    public function getImage() { return $this->image; }

    public function setTen($ten) { $this->ten = $ten; }
    public function setMota($mota) { $this->mota = $mota; }
    public function setGia($gia) { $this->gia = $gia; }
    public function setIdDm($id_dm) { $this->id_dm = $id_dm; }
    public function setImage($image) { $this->image = $image; }

    public function __construct($id = null, $ten = '', $mota = '', $gia = 0, $id_dm = 0, $image = '') {
        $this->id = $id;
        $this->ten = $ten;
        $this->mota = $mota;
        $this->gia = $gia;
        $this->id_dm = $id_dm;
        $this->image = $image;
        $this->link = null;
    }

    public function getAll() {
        $this->link = taoKetNoi($this->link);
        $sql = "SELECT sp.*, dm.ten as ten_danhmuc FROM tbl_sanpham sp 
                LEFT JOIN tbl_danhmuc dm ON sp.id_dm = dm.id 
                ORDER BY sp.ten";
        $result = chayTruyVanTraVeDL($this->link, $sql);
        $products = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
        
        giaiPhongBoNho($this->link, $result);
        return $products;
    }

    public function getById($id) {
        $this->link = taoKetNoi($this->link);
        $sql = "SELECT sp.*, dm.ten as ten_danhmuc FROM tbl_sanpham sp 
                LEFT JOIN tbl_danhmuc dm ON sp.id_dm = dm.id 
                WHERE sp.id = " . (int)$id;
        $result = chayTruyVanTraVeDL($this->link, $sql);
        $product = null;
        
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        }
        
        giaiPhongBoNho($this->link, $result);
        return $product;
    }

    public function getByCategory($id_dm) {
        $this->link = taoKetNoi($this->link);
        $sql = "SELECT sp.*, dm.ten as ten_danhmuc FROM tbl_sanpham sp 
                LEFT JOIN tbl_danhmuc dm ON sp.id_dm = dm.id 
                WHERE sp.id_dm = " . (int)$id_dm . " ORDER BY sp.ten";
        $result = chayTruyVanTraVeDL($this->link, $sql);
        $products = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
        
        giaiPhongBoNho($this->link, $result);
        return $products;
    }

    public function save() {
        $this->link = taoKetNoi($this->link);
        $ten = escapeString($this->link, $this->ten);
        $mota = escapeString($this->link, $this->mota);
        $image = escapeString($this->link, $this->image);
        
        $sql = "INSERT INTO tbl_sanpham (ten, mota, gia, id_dm, image) 
                VALUES ('$ten', '$mota', {$this->gia}, {$this->id_dm}, '$image')";
        
        $result = chayTruyVanKhongTraVeDL($this->link, $sql);
        giaiPhongBoNho($this->link, null);
        return $result;
    }

    public function __toString() {
        return "HangHoa($this->id, $this->ten, $this->mota, $this->gia, $this->id_dm, $this->image)";
    }
}
?>