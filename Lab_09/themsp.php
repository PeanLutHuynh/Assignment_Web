<?php
// Kết nối database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hanghoa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy danh sách danh mục
    $sql_dm = "SELECT id, ten FROM tbl_danhmuc ORDER BY ten";
    $stmt_dm = $conn->prepare($sql_dm);
    $stmt_dm->execute();
    $danhmucs = $stmt_dm->fetchAll(PDO::FETCH_ASSOC);
    
    if ($_POST) {
        $ten_sanpham = $_POST['ten_sanpham'];
        $mota = $_POST['mota'];
        $gia = $_POST['gia'];
        $id_dm = $_POST['id_dm'];

        $sql = "INSERT INTO tbl_sanpham (ten, mota, gia, id_dm) VALUES (:ten_sanpham, :mota, :gia, :id_dm)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_sanpham', $ten_sanpham);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':gia', $gia);
        $stmt->bindParam(':id_dm', $id_dm);

        if ($stmt->execute()) {
            echo "<div style='color: green; padding: 10px; border: 1px solid green; margin: 10px 0;'>Thêm sản phẩm thành công!</div>";
            echo "<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>";
        } else {
            echo "<div style='color: red; padding: 10px; border: 1px solid red; margin: 10px 0;'>Lỗi khi thêm sản phẩm!</div>";
        }
    }
} catch(PDOException $e) {
    echo "<div style='color: red; padding: 10px; border: 1px solid red; margin: 10px 0;'>Lỗi kết nối: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sản Phẩm</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; }
        td { padding: 10px; }
        input[type="text"], textarea, select { width: 300px; padding: 5px; }
        input[type="submit"], input[type="reset"] { padding: 10px 20px; margin: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Thêm Sản Phẩm Mới</h2>
    
    <form method="POST" action="">
        <table>
            <tr>
                <td>Tên sản phẩm:</td>
                <td><input type="text" name="ten_sanpham" required></td>
            </tr>
            <tr>
                <td>Mô tả:</td>
                <td><textarea name="mota" rows="4" required></textarea></td>
            </tr>
            <tr>
                <td>Giá:</td>
                <td><input type="text" name="gia" required></td>
            </tr>
            <tr>
                <td>Danh mục:</td>
                <td>
                    <select name="id_dm" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach($danhmucs as $dm): ?>
                            <option value="<?php echo $dm['id']; ?>"><?php echo htmlspecialchars($dm['ten']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Thêm sản phẩm">
                    <input type="reset" value="Nhập lại">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>