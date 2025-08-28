<!--
Cho một mảng có 4 phần tử dùng để mô tả một đối tượng Nhân viên: NhanVien(id, hoten, tuoi, hsl).

a) Hãy khai báo mảng NhanVien với mô tả ở trên.

b) Xây dựng hàm khởi tạo thông tin cho đối tượng nhân viên.

c) Xây dựng hàm khởi tạo thông tin cho nhiều đối tượng nhân viên, mỗi nhân viên là một phần tử trong một mảng khác (nghĩa là mảng của mảng NhanVien ở trên).

d) Xây dựng hàm tạo một bảng table để hiển thị thông tin của mảng nhiều nhân viên ở câu c.

e) Xây dựng hàm khởi tạo màu ngẫu nhiên cho từng dòng dữ liệu trong bảng.

1) Xây dựng hàm khởi tạo màu chẵn lẻ (dòng chẵn màu sáng, dòng lẻ màu tối) cho bảng.

g) Trong phần hiển thị chương trình, cho phép chuyển đổi qua lại giữa hai dạng style ở câu e và f.
-->

<?php
// Khởi tạo dữ liệu
$NhanVien = array(
    'id' => null,
    'hoten' => null,
    'tuoi' => null,
    'hsl' => null
);

function taoNhanVien($id, $hoten, $tuoi, $hsl) {
    return [
        'id' => $id,
        'hoten' => $hoten,
        'tuoi' => $tuoi,
        'hsl' => $hsl
    ];
}

function taoMangNhanVien() {
    return [
        taoNhanVien(1, 'Nguyen Van A', 30, 2.5),
        taoNhanVien(2, 'Tran Thi B', 25, 3.0),
        taoNhanVien(3, 'Le Van C', 28, 2.8),
        taoNhanVien(4, 'Pham Thi D', 32, 3.2)
    ];
}

// Hiển thị table
function taoTable($mangNhanVien, $kieuMau = 'chanle') {
    $tableClass = ($kieuMau === 'chanle') ? 'table table-bordered' : 'table table-bordered';
    echo "<table class='$tableClass'>";
    echo "<thead>";
    echo "<tr><th>ID</th><th>Họ tên</th><th>Tuổi</th><th>Hệ số lương</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($mangNhanVien as $index => $nv) {
        $mau = ($kieuMau === 'chanle') ? mauChanLe($index) : mauNgauNhien();
        echo "<tr style='background-color: $mau !important'>";
        echo "<td>{$nv['id']}</td>";
        echo "<td>{$nv['hoten']}</td>";
        echo "<td>{$nv['tuoi']}</td>";
        echo "<td>{$nv['hsl']}</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// Xử lý màu sắc
function mauNgauNhien() {
    $mau = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    return $mau;
}

function mauChanLe($soDong) {
    return ($soDong % 2 === 0) ? '#cccccc' : '#f2f2f2';
}

// Xử lý chuyển đổi
$kieuHienThi = $_GET['style'] ?? 'chanle';
$mangNhanVien = taoMangNhanVien();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table th {
            background-color: #198754 !important;
            color: white !important;
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        /* Ghi đè Bootstrap striped */
        .table-bordered > tbody > tr > td {
            border: 1px solid #dee2e6 !important;
        }
        .table > tbody > tr:nth-of-type(odd) > td {
            background-color: inherit !important;
        }
        .table > tbody > tr:nth-of-type(even) > td {
            background-color: inherit !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0 text-center">Quản lý Nhân viên</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form method="get" class="d-flex align-items-center gap-3">
                        <label for="style" class="form-label mb-0">Chọn kiểu hiển thị:</label>
                        <select name="style" id="style" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="chanle" <?= $kieuHienThi === 'chanle' ? 'selected' : '' ?>>Chẵn lẻ</option>
                            <option value="ngauNhien" <?= $kieuHienThi === 'ngauNhien' ? 'selected' : '' ?>>Ngẫu nhiên</option>
                        </select>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <?php taoTable($mangNhanVien, $kieuHienThi); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>