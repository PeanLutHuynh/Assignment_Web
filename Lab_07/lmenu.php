<?php
require_once "data.php";
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
        echo "<div style='padding:5px; margin:2px 0; background-color:rgba(255,255,255,0.3); border-radius:5px; font-size:12px; border-left:3px solid #036;'>• " . $productName . "</div>";
    }
    echo "</div>";
}
?>
