<?php
require_once __DIR__ . "/config.php";

function taoKetNoi($link) {
    $link = mysqli_connect(HOST, USER, PASSWORD, DB);
    if (mysqli_connect_errno()) {
        echo "Lỗi kết nối đến máy chủ: " . mysqli_connect_error();
        exit();
    }
    return $link;
}

function chayTruyVanTraVeDL($link, $q) {
    $result = mysqli_query($link, $q);
    return $result;
}

function chayTruyVanKhongTraVeDL($link, $q) {
    $result = mysqli_query($link, $q);
    return $result;
}

function giaiPhongBoNho($link, $result) {
    try {
        mysqli_close($link);
        if (isset($result)) {
            mysqli_free_result($result);
        }
    } catch (TypeError $e) {
    }
}

// Helper function to escape strings
function escapeString($link, $string) {
    return mysqli_real_escape_string($link, trim($string));
}

// Helper function to check if table exists
function tableExists($link, $tableName) {
    $query = "SHOW TABLES LIKE '$tableName'";
    $result = mysqli_query($link, $query);
    return mysqli_num_rows($result) > 0;
}

// Helper function to create tables if they don't exist
function createTablesIfNotExist($link) {
    // Create tbl_danhmuc if not exists
    if (!tableExists($link, 'tbl_danhmuc')) {
        $sql = "CREATE TABLE tbl_danhmuc (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ten VARCHAR(255) NOT NULL
        )";
        mysqli_query($link, $sql);
    }
    
    // Create tbl_sanpham if not exists
    if (!tableExists($link, 'tbl_sanpham')) {
        $sql = "CREATE TABLE tbl_sanpham (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ten VARCHAR(255) NOT NULL,
            mota TEXT,
            gia DECIMAL(10,2) NOT NULL,
            id_dm INT,
            image VARCHAR(255) DEFAULT '',
            FOREIGN KEY (id_dm) REFERENCES tbl_danhmuc(id)
        )";
        mysqli_query($link, $sql);
    } else {
        // Thêm cột image nếu chưa có
        $checkColumn = "SHOW COLUMNS FROM tbl_sanpham LIKE 'image'";
        $result = mysqli_query($link, $checkColumn);
        if (mysqli_num_rows($result) == 0) {
            $addColumn = "ALTER TABLE tbl_sanpham ADD COLUMN image VARCHAR(255) DEFAULT '' AFTER id_dm";
            mysqli_query($link, $addColumn);
        }
    }
}
?>