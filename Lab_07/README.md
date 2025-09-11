# Cửa hàng điện tử công nghệ

## Mô tả dự án
Website bán hàng điện tử với các danh mục sản phẩm: Laptop, Tablet, Smartphone, và Tivi.

## Cấu trúc file
- `index.php` - Trang chính
- `data.php` - Dữ liệu sản phẩm
- `lmenu.php` - Menu bên trái (danh sách sản phẩm dạng text)
- `content.php` - Nội dung chính (hiển thị sản phẩm với hình ảnh)
- `styles.css` - File CSS cho giao diện
- `images/` - Thư mục chứa hình ảnh sản phẩm

## Tính năng
- Menu điều hướng giữa các danh mục
- Hiển thị sản phẩm theo thương hiệu
- Giao diện responsive
- Placeholder icon khi không có hình ảnh
- Thiết kế gradient đẹp mắt

## Cách sử dụng
1. Đặt tất cả file trong thư mục web server
2. Truy cập `index.php` qua trình duyệt
3. Click vào các menu để chuyển đổi danh mục

## Thêm hình ảnh
Để hiển thị hình ảnh sản phẩm, hãy thêm file ảnh (định dạng .jpg) vào thư mục `images/` với tên file theo format:
- Chuyển tên sản phẩm thành chữ thường
- Thay dấu cách bằng dấu gạch dưới (_)

Ví dụ:
- "iPhone 5" → `iphone_5.jpg`
- "MacBook Pro" → `macbook_pro.jpg`
- "Galaxy S4" → `galaxy_s4.jpg`

## Công nghệ sử dụng
- PHP 7+
- HTML5
- CSS3 (Flexbox, Grid, Gradient)
- Responsive Design
