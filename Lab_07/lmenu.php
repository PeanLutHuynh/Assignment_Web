<?php
require_once "data.php";
$cag = $_GET['gr'] ?? 'Laptop';
if (!$cag || !array_key_exists($cag, $data)) {
    $keys = array_keys($data);
    header("Location: ?gr=" . $keys[0]);
    exit;
}
$man = $data[$cag];
foreach ($man as $mankey => $manval) {
    echo "<div class='nav_bar'>" . $mankey . "</div>";
    echo "<div style='padding-bottom:15px;'>";
    foreach ($manval as $product) {
        // Kiểm tra định dạng dữ liệu (mới có ID hoặc cũ chỉ có tên)
        if (is_array($product) && isset($product['name'])) {
            $productName = $product['name'];
        } else {
            $productName = $product;
        }
        
        echo "<div style='padding:5px; margin:2px 0; background-color:rgba(255,255,255,0.3); border-radius:5px; font-size:12px; border-left:3px solid #036;'>";
        echo "• " . $productName;
        echo "</div>";
    }
    echo "</div>";
}
?>
