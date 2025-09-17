<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Form Đăng Ký</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();
                        
                        if (isset($_SESSION['errors'])) {
                            echo '<div class="alert alert-danger">';
                            echo '<h4>Có lỗi xảy ra:</h4>';
                            foreach ($_SESSION['errors'] as $error) {
                                echo '- ' . $error . '<br>';
                            }
                            echo '</div>';
                            unset($_SESSION['errors']);
                        }
                        
                        $formData = $_SESSION['form_data'] ?? [];
                        if (isset($_SESSION['form_data'])) {
                            unset($_SESSION['form_data']);
                        }
                        ?>
                        
                        <form method="POST" action="process.php">
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?php echo htmlspecialchars($formData['username'] ?? ''); ?>" required>
                            </div>
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <!-- Age -->
                            <div class="mb-3">
                                <label for="age" class="form-label">Age: <span id="ageValue">0</span></label>
                                <input type="range" class="form-range" id="age" name="age" min="0" max="100" 
                                       value="<?php echo htmlspecialchars($formData['age'] ?? '0'); ?>"
                                       oninput="document.getElementById('ageValue').textContent = this.value">
                            </div>
                            
                            <!-- Hobby (Checkboxes) -->
                            <div class="mb-3">
                                <label class="form-label">Hobby</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby1" name="hobby[]" value="Thể thao"
                                           <?php echo (isset($formData['hobby']) && in_array('Thể thao', $formData['hobby'])) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hobby1">Thể thao</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby2" name="hobby[]" value="Âm nhạc"
                                           <?php echo (isset($formData['hobby']) && in_array('Âm nhạc', $formData['hobby'])) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hobby2">Âm nhạc</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby3" name="hobby[]" value="Nghệ thuật"
                                           <?php echo (isset($formData['hobby']) && in_array('Nghệ thuật', $formData['hobby'])) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hobby3">Nghệ thuật</label>
                                </div>
                            </div>
                            
                            <!-- Country (Select) -->
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">Chọn quốc gia...</option>
                                    <option value="Việt Nam" <?php echo (isset($formData['country']) && $formData['country'] == 'Việt Nam') ? 'selected' : ''; ?>>Việt Nam</option>
                                    <option value="Hàn Quốc" <?php echo (isset($formData['country']) && $formData['country'] == 'Hàn Quốc') ? 'selected' : ''; ?>>Hàn Quốc</option>
                                    <option value="Mỹ" <?php echo (isset($formData['country']) && $formData['country'] == 'Mỹ') ? 'selected' : ''; ?>>Mỹ</option>
                                    <option value="Nhật Bản" <?php echo (isset($formData['country']) && $formData['country'] == 'Nhật Bản') ? 'selected' : ''; ?>>Nhật Bản</option>
                                    <option value="Trung Quốc" <?php echo (isset($formData['country']) && $formData['country'] == 'Trung Quốc') ? 'selected' : ''; ?>>Trung Quốc</option>
                                </select>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Đăng Ký</button>
                                <button type="button" class="btn btn-secondary" onclick="cancelForm()">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cancelForm() {
            if (confirm('Bạn có chắc muốn hủy và làm mới form?')) {
                window.location.reload();
            }
        }
    </script>
</body>
</html>