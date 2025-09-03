<?php
// a) Khai báo mảng NhanVien
$NhanVien = array(
    'id' => null,
    'hoten' => null,
    'tuoi' => null,
    'hsl' => null
);

// b) Hàm khởi tạo thông tin cho đối tượng nhân viên
function taoNhanVien($id, $hoten, $tuoi, $hsl) {
    return [
        'id' => $id,
        'hoten' => $hoten,
        'tuoi' => $tuoi,
        'hsl' => $hsl
    ];
}

// c) Hàm khởi tạo thông tin cho nhiều đối tượng nhân viên
function taoMangNhanVien() {
    return [
        taoNhanVien(1, 'Nguyen Van A', 30, 2.5),
        taoNhanVien(2, 'Tran Thi B', 25, 3.0),
        taoNhanVien(3, 'Le Van C', 28, 2.8),
        taoNhanVien(4, 'Pham Thi D', 32, 3.2),
        taoNhanVien(5, 'Hoang Van E', 35, 2.9),
        taoNhanVien(6, 'Vo Thi F', 27, 3.1)
    ];
}

// Tạo dữ liệu cho JavaScript
$mangNhanVien = taoMangNhanVien();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên - PHP + JavaScript</title>
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
        .table td {
            border: 1px solid #dee2e6 !important;
        }
        .table tbody tr td {
            background-color: inherit !important;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 2px 8px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        #employeeTable tr {
            transition: background-color 0.3s ease;
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
                <!-- Buttons điều khiển -->
                <div class="mb-3">
                    <button id="loadBtn" class="btn btn-primary">Load Data</button>
                    <button id="evenOddBtn" class="btn btn-success">Màu Chẵn/Lẻ</button>
                    <button id="randomBtn" class="btn btn-warning">Màu Ngẫu Nhiên</button>
                </div>
                
                <!-- Container cho bảng -->
                <div class="table-responsive">
                    <div id="tableContainer">
                        <p class="text-muted">Nhấn "Load Data" để hiển thị bảng nhân viên</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dữ liệu từ PHP chuyển sang JavaScript
        const employeeData = <?php echo json_encode($mangNhanVien); ?>;
        let currentStyle = 'evenOdd'; // Mặc định màu chẵn lẻ
        
        // d) Hàm tạo bảng table
        function createTable(data, style = 'evenOdd') {
            let html = `
                <table id="employeeTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Tuổi</th>
                            <th>Hệ số lương</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.forEach((employee, index) => {
                const bgColor = (style === 'evenOdd') ? getEvenOddColor(index) : getRandomColor();
                html += `
                    <tr style="background-color: ${bgColor}">
                        <td>${employee.id}</td>
                        <td>${employee.hoten}</td>
                        <td>${employee.tuoi}</td>
                        <td>${employee.hsl}</td>
                        <td><button class="btn-delete" onclick="deleteRow(this)">Xóa</button></td>
                    </tr>
                `;
            });
            
            html += `
                    </tbody>
                </table>
            `;
            
            document.getElementById('tableContainer').innerHTML = html;
        }
        
        // f) Hàm màu chẵn lẻ (dòng chẵn sáng, dòng lẻ tối)
        function getEvenOddColor(index) {
            return (index % 2 === 0) ? '#9ea2a4ff' : '#e9ecef';
        }
        
        // e) Hàm màu ngẫu nhiên
        function getRandomColor() {
            return '#' + Math.floor(Math.random()*16777215).toString(16).padStart(6, '0');
        }
        
        // Hàm xóa dòng
        function deleteRow(button) {
            if (confirm('Bạn có chắc muốn xóa dòng này?')) {
                const row = button.closest('tr');
                row.remove();
                
                // Cập nhật lại màu sau khi xóa (nếu đang ở chế độ chẵn lẻ)
                if (currentStyle === 'evenOdd') {
                    updateEvenOddColors();
                }
            }
        }
        
        // Cập nhật màu chẵn lẻ sau khi xóa
        function updateEvenOddColors() {
            const rows = document.querySelectorAll('#employeeTable tbody tr');
            rows.forEach((row, index) => {
                row.style.backgroundColor = getEvenOddColor(index);
            });
        }
        
        // g) Chuyển đổi style
        function applyEvenOddStyle() {
            currentStyle = 'evenOdd';
            const table = document.getElementById('employeeTable');
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach((row, index) => {
                    row.style.backgroundColor = getEvenOddColor(index);
                });
                console.log('Applied even/odd style to', rows.length, 'rows');
            }
        }
        
        function applyRandomStyle() {
            currentStyle = 'random';
            const table = document.getElementById('employeeTable');
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach((row) => {
                    row.style.backgroundColor = getRandomColor();
                });
                console.log('Applied random style to', rows.length, 'rows');
            }
        }
        
        // Event listeners
        document.getElementById('loadBtn').addEventListener('click', function() {
            createTable(employeeData, currentStyle);
            console.log('Table loaded with style:', currentStyle);
        });
        
        document.getElementById('evenOddBtn').addEventListener('click', function() {
            const table = document.getElementById('employeeTable');
            if (table) {
                applyEvenOddStyle();
            } else {
                alert('Vui lòng load data trước!');
            }
        });
        
        document.getElementById('randomBtn').addEventListener('click', function() {
            const table = document.getElementById('employeeTable');
            if (table) {
                applyRandomStyle();
            } else {
                alert('Vui lòng load data trước!');
            }
        });
    </script>
</body>
</html>