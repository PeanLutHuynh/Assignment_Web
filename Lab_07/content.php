<?php
require_once "data.php";
require_once "image_mapping.php";

$cag = $_GET['gr'] ?? 'Laptop';
if (!$cag || !array_key_exists($cag, $data)) {
    $keys = array_keys($data);
    header("Location: ?gr=" . $keys[0]);
    exit;
}

foreach ($data[$cag] as $brand => $products) {
    echo "<div class='nav_bar'>" . $brand . "</div>";
    echo "<div style='padding-bottom:15px;'>";
    
    foreach ($products as $product) {
        $productName = is_array($product) ? $product['name'] : $product;
        $imagePath = is_array($product) ? getImagePath($product['id']) : null;
        
        echo "<div class='prd_item'>";
        
        if ($imagePath && file_exists($imagePath)) {
            echo "<img src='" . $imagePath . "' alt='" . $productName . "' class='product_image'>";
        } else {
            echo "<div class='product_image' style='display:flex; align-items:center; justify-content:center; background:#f0f0f0; color:#999; font-size:12px;'>Không có ảnh</div>";
        }
        
        echo "<div class='product_name'>" . $productName . "</div>";
        echo "</div>";
    }
    
    echo "<br style='clear:both;'></div>";
}
?>
