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
    foreach($manval as $prod){
        echo "<div style='padding:5px; margin:2px 0; background-color:rgba(255,255,255,0.3); border-radius:5px; font-size:12px; border-left:3px solid #036;'>";
        echo "• ".$prod;
        echo "</div>";
    }
    echo "</div>";
}
?>
