<?php
// Kết nối database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hanghoa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_POST) {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        
        $sql = "INSERT INTO tbl_danhmuc (ten) VALUES (:ten_danhmuc)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_danhmuc', $ten_danhmuc);
        
        if ($stmt->execute()) {
            echo "<div style='color: green; padding: 10px; border: 1px solid green; margin: 10px 0;'>Thêm danh mục thành công!</div>";
            echo "<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>";
        } else {
            echo "<div style='color: red; padding: 10px; border: 1px solid red; margin: 10px 0;'>Lỗi khi thêm danh mục!</div>";
        }
    }
} catch(PDOException $e) {
    echo "<div style='color: red; padding: 10px; border: 1px solid red; margin: 10px 0;'>Lỗi kết nối: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Danh Mục</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; }
        td { padding: 10px; }
        input[type="text"], textarea { width: 300px; padding: 5px; }
        input[type="submit"], input[type="reset"] { padding: 10px 20px; margin: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Thêm Danh Mục Mới</h2>
    
    <form method="POST" action="">
        <table>
            <tr>
                <td>Tên danh mục:</td>
                <td><input type="text" name="ten_danhmuc" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Thêm danh mục">
                    <input type="reset" value="Nhập lại">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>