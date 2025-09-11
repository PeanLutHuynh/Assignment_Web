<?php
$imageMapping = array(
    1 => "imac.jpg",
    2 => "macbook_pro.jpg",
    3 => "macbook_air.jpg",
    4 => "asus_zenbook.jpg",
    5 => "asus_transformer_book.jpg",
    6 => "sony_tablet_z.jpg",
    7 => "sony_tablet_s.jpg",
    8 => "galaxy_nexus_10.jpg",
    9 => "galaxy_tab_10.1.jpg",
    10 => "iphone_xi.jpg",
    11 => "iphone_x.jpg",
    12 => "galaxy_z.jpg",
    13 => "galaxy_a35.jpg",
    14 => "sharp_android.jpg",
    15 => "sharp_telewizor.jpg",
    16 => "sony_x75k.jpg",
    17 => "sony_bravia.jpg"
);

function getImagePath($productId) {
    global $imageMapping;
    if (isset($imageMapping[$productId])) {
        $imagePath = "images/" . $imageMapping[$productId];
        if (file_exists($imagePath)) {
            return $imagePath;
        }
    }
    return null;
}
?>
