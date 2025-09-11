<?php
// Mapping giữa ID sản phẩm và tên file ảnh
$imageMapping = array(
    // Laptop - Apple
    1 => "imac.jpg",                    // iMac
    2 => "macbook_pro.jpg",             // MacBook Pro
    3 => "macbook_air.jpg",             // MacBook Air
    
    // Laptop - Asus
    4 => "asus_zenbook.jpg",            // Asus Zenbook
    5 => "asus_transformer_book.jpg",   // Asus Transformer Book
    
    // Tablet - Sony
    6 => "sony_tablet_z.jpg",           // Sony Tablet Z
    7 => "sony_tablet_s.jpg",           // Sony Tablet S
    
    // Tablet - Samsung
    8 => "galaxy_nexus_10.jpg",         // Galaxy Nexus 10
    9 => "galaxy_tab_10.1.jpg",         // Galaxy Tab 10.1
    
    // Smartphone - Apple
    10 => "iphone_xi.jpg",              // iPhone XI
    11 => "iphone_x.jpg",               // iPhone X
    
    // Smartphone - Samsung
    12 => "galaxy_z.jpg",               // Galaxy Z
    13 => "galaxy_a35.jpg",             // Galaxy A35
    
    // Tivi - Sharp
    14 => "sharp_android.jpg",          // Sharp Android
    15 => "sharp_telewizor.jpg",        // Sharp Telewizor
    
    // Tivi - Sony
    16 => "sony_x75k.jpg",              // Sony X75K
    17 => "sony_bravia.jpg"             // Sony Bravia
);

// Hàm lấy đường dẫn ảnh theo ID
function getImagePath($productId) {
    global $imageMapping;
    
    // Kiểm tra ID có tồn tại trong mapping không
    if (isset($imageMapping[$productId])) {
        $imageName = $imageMapping[$productId];
        $imagePath = "images/" . $imageName;
        
        // Kiểm tra file ảnh có tồn tại không
        if (file_exists($imagePath)) {
            return $imagePath;
        }
    }
    
    // Nếu không tìm thấy, trả về null
    return null;
}
?>
