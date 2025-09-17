<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit();
}

$username = trim(htmlspecialchars($_POST['username'] ?? ''));
$password = $_POST['password'] ?? '';
$age = intval($_POST['age'] ?? 0);
$hobbies = $_POST['hobby'] ?? [];
$country = htmlspecialchars($_POST['country'] ?? '');

$errors = [];

if (empty($username)) {
    $errors[] = "Username không được để trống";
} elseif (strlen($username) < 3) {
    $errors[] = "Username phải có ít nhất 3 ký tự";
} elseif (strlen($username) > 50) {
    $errors[] = "Username không được quá 50 ký tự";
} elseif (!preg_match('/^[\p{L}\p{N}_]+$/u', $username)) {
    $errors[] = "Username chỉ được chứa chữ cái, số và dấu gạch dưới";
}

if (empty($password)) {
    $errors[] = "Password không được để trống";
} elseif (strlen($password) < 6) {
    $errors[] = "Password phải có ít nhất 6 ký tự";
} elseif (strlen($password) > 100) {
    $errors[] = "Password không được quá 100 ký tự";
}

if ($age <= 6) {
    $errors[] = "Bạn phải ít nhất 7 tuổi để đăng ký";
}

$validCountries = ['Việt Nam', 'Hàn Quốc', 'Mỹ', 'Nhật Bản', 'Trung Quốc'];
if (empty($country)) {
    $errors[] = "Vui lòng chọn quốc gia";
} elseif (!in_array($country, $validCountries)) {
    $errors[] = "Quốc gia được chọn không hợp lệ";
}

$validHobbies = ['Thể thao', 'Âm nhạc', 'Nghệ thuật'];
foreach ($hobbies as $hobby) {
    if (!in_array($hobby, $validHobbies)) {
        $errors[] = "Sở thích '{$hobby}' không hợp lệ";
        break;
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: index.php");
    exit();
}

$_SESSION['success_message'] = "Đăng ký thành công!";

$_POST['processed'] = true;
include 'result.php';
exit();
?>