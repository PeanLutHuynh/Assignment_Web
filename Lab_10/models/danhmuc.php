<?php
require_once __DIR__ . '/../modules/db_module.php';

class Danhmuc {
    private $id;
    private $ten;
    private $link;

    public function getId() { return $this->id; }
    public function getTen() { return $this->ten; }
    public function setTen($ten) { $this->ten = $ten; }

    public function __construct($id = null, $ten = '') {
        $this->id = $id;
        $this->ten = $ten;
        $this->link = null;
    }

    public function getAll() {
        $this->link = taoKetNoi($this->link);
        $sql = "SELECT * FROM tbl_danhmuc ORDER BY ten";
        $result = chayTruyVanTraVeDL($this->link, $sql);
        $categories = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }
        
        giaiPhongBoNho($this->link, $result);
        return $categories;
    }

    public function getById($id) {
        $this->link = taoKetNoi($this->link);
        $sql = "SELECT * FROM tbl_danhmuc WHERE id = " . (int)$id;
        $result = chayTruyVanTraVeDL($this->link, $sql);
        $category = null;
        
        if ($result && mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
        }
        
        giaiPhongBoNho($this->link, $result);
        return $category;
    }

    public function save() {
        $this->link = taoKetNoi($this->link);
        $ten = escapeString($this->link, $this->ten);
        
        $sql = "INSERT INTO tbl_danhmuc (ten) VALUES ('$ten')";
        $result = chayTruyVanKhongTraVeDL($this->link, $sql);
        
        giaiPhongBoNho($this->link, null);
        return $result;
    }

    public function __toString() {
        return "DanhMuc($this->id, $this->ten)";
    }
}
?>