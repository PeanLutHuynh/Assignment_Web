<?php
require_once "data.php";
$cag = $_GET['gr'];
if(!$cag || !array_key_exists($cag, $data)){
    $keys = array_keys($data);
    header("Location: ?gr=".$keys[0]);
}
$man = $data[$cag];
foreach($man as $mankey => $manval){
    echo "<div class='nav_bar'> ".$mankey."</div>";
    echo "<div style='padding-bottom:15px;'>";
    foreach($manval as $index => $prod){
        $image_name = strtolower(str_replace(' ', '_', $prod));
        $image_path = "images/".$image_name.".jpg";
        
        echo "<div class='prd_item'>";
        
        // Kiểm tra nếu file ảnh tồn tại
        if(file_exists($image_path)) {
            echo "<img src='".$image_path."' alt='".$prod."' class='product_image'>";
        } else {
            // Hiển thị placeholder nếu không có ảnh
            $icons = ['💻', '📱', '📺', '⌚', '🎧', '📷', '🖥️', '⌨️'];
            $icon = $icons[$index % count($icons)];
            echo "<div class='product_image'>".$icon."<br>".substr($prod, 0, 10)."</div>";
        }
        
        echo "<div class='product_name'>".$prod."</div>";
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
