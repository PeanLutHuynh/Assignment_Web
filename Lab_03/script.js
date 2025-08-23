// Quản lý người dùng đơn giản
let users = [];
let currentEditIndex = -1;

// Khởi tạo khi trang load
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
    renderTable();
    
    // Xử lý submit form
    document.getElementById('userForm').addEventListener('submit', handleSubmit);
    document.getElementById('cancelBtn').addEventListener('click', cancelEdit);
});

// Xử lý submit form
function handleSubmit(e) {
    e.preventDefault();
    
    const hoTen = document.getElementById('hoTen').value.trim();
    const ngaySinh = document.getElementById('ngaySinh').value;
    const gioiTinh = document.querySelector('input[name="gioiTinh"]:checked')?.value || '';
    const queQuan = document.getElementById('queQuan').value.trim();

    // Kiểm tra dữ liệu
    if (!hoTen) {
        alert('Vui lòng nhập họ tên!');
        return;
    }
    
    const userData = {
        hoTen: hoTen,
        ngaySinh: ngaySinh,
        gioiTinh: gioiTinh,
        queQuan: queQuan
    };
    
    if (currentEditIndex >= 0) {
        // Cập nhật
        users[currentEditIndex] = userData;
        alert('Cập nhật thành công!');
    } else {
        // Thêm mới
        users.push(userData);
        alert('Thêm thành công!');
    }
    
    saveUsers();
    renderTable();
    resetForm();
}

// Thêm người dùng mới
function addUser(userData) {
    users.push(userData);
    saveUsers();
    renderTable();
}

// Sửa người dùng
function editUser(index) {
    const user = users[index];
    if (user) {
        currentEditIndex = index;
        
        // Điền dữ liệu vào form
        document.getElementById('hoTen').value = user.hoTen;
        document.getElementById('ngaySinh').value = user.ngaySinh;
        if (user.gioiTinh) {
            document.querySelector(`input[name="gioiTinh"][value="${user.gioiTinh}"]`).checked = true;
        }
        document.getElementById('queQuan').value = user.queQuan;
        
        // Thay đổi giao diện
        document.getElementById('formTitle').textContent = 'Sửa người dùng';
        document.getElementById('submitBtn').textContent = 'Cập nhật';
        document.getElementById('cancelBtn').style.display = 'inline-block';
    }
}

// Xóa người dùng
function deleteUser(index) {
    const user = users[index];
    if (user && confirm(`Bạn có chắc muốn xóa "${user.hoTen}"?`)) {
        users.splice(index, 1);
        saveUsers();
        renderTable();
        alert('Xóa thành công!');
        
        // Nếu đang sửa user này thì hủy
        if (currentEditIndex === index) {
            resetForm();
        }
    }
}

// Hủy chỉnh sửa
function cancelEdit() {
    resetForm();
}

// Reset form
function resetForm() {
    document.getElementById('userForm').reset();
    currentEditIndex = -1;
    
    document.getElementById('formTitle').textContent = 'Thêm người dùng';
    document.getElementById('submitBtn').textContent = 'Thêm';
    document.getElementById('cancelBtn').style.display = 'none';
}

// Hiển thị bảng
function renderTable() {
    const tbody = document.getElementById('userTableBody');
    
    if (users.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #666;">Chưa có dữ liệu</td></tr>';
        return;
    }
    
    let html = '';
    users.forEach((user, index) => {
        html += `
            <tr>
                <td>${index + 1}</td>
                <td>${user.hoTen}</td>
                <td>${user.ngaySinh || '-'}</td>
                <td>${user.gioiTinh || '-'}</td>
                <td>${user.queQuan || '-'}</td>
                <td>
                    <button class="btn btn-warning" onclick="editUser(${index})">Sửa</button>
                    <button class="btn btn-danger" onclick="deleteUser(${index})">Xóa</button>
                </td>
            </tr>
        `;
    });
    
    tbody.innerHTML = html;
}

// Lưu vào localStorage
function saveUsers() {
    localStorage.setItem('users', JSON.stringify(users));
}

// Tải từ localStorage
function loadUsers() {
    const saved = localStorage.getItem('users');
    if (saved) {
        users = JSON.parse(saved);
    }
}
