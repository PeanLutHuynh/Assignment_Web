<?php
require_once "data.php";
require_once "image_mapping.php";

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
        if (is_array($product) && isset($product['id'])) {
            // Định dạng mới với ID
            $productName = $product['name'];
            $imagePath = getImagePath($product['id']);
        } else {
            // Định dạng cũ chỉ có tên (fallback)
            $productName = $product;
            $image_name = strtolower(str_replace(' ', '_', $product));
            $imagePath = "images/" . $image_name . ".jpg";
        }
        
        echo "<div class='prd_item'>";
        
        // Hiển thị ảnh
        if ($imagePath && file_exists($imagePath)) {
            echo "<img src='" . $imagePath . "' alt='" . $productName . "' class='product_image'>";
        } else {
            // Hiển thị placeholder đơn giản
            echo "<div class='product_image' style='display:flex; align-items:center; justify-content:center; background:#f0f0f0; color:#999; font-size:12px;'>";
            echo "Không có ảnh";
            echo "</div>";
        }
        
        echo "<div class='product_name'>" . $productName . "</div>";
        echo "</div>";
    }
    
    echo "<br style='clear:both;'>";
    echo "</div>";
}
?>
<style>
.nav_bar{
    padding:3px 5px;
    background-color:#036;
    color:white;
    font-weight:bold;
    margin-top:5px;
}
.prd_item{
    width:150px;
    height:180px;
    background-color:#336;
    border:solid 1px white;
    color:white;
    text-align:center;
    padding:10px;
    margin:0px 3px 3px 3px;
    float:left;
    display:flex;
    flex-direction:column;
    align-items:center;
}
.product_image{
    width:100px;
    height:100px;
    object-fit:cover;
    border:2px solid white;
    border-radius:5px;
    margin-bottom:10px;
}
.product_name{
    font-size:12px;
    font-weight:bold;
    text-align:center;
}
</style>
