<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-card {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .info-item {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }
        
        .info-item:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .info-label {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .info-value {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .hobby-badge {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin: 5px;
            display: inline-block;
        }
        
        .success-icon {
            font-size: 60px;
            color: #28a745;
            animation: bounce 1s ease-in-out;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .action-buttons {
            margin-top: 30px;
        }
        
        .btn-custom {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin: 5px;
        }
        
        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }
        
        .country-flag {
            width: 24px;
            height: 16px;
            border-radius: 2px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST" && !isset($_POST['processed'])) {
        header("Location: index.php");
        exit();
    }
    
    $username = htmlspecialchars($_POST['username'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $hobbies = $_POST['hobby'] ?? [];
    $country = htmlspecialchars($_POST['country'] ?? '');
    
    // Mapping quốc gia với emoji flag
    $countryFlags = [
        'Việt Nam' => '🇻🇳',
        'Hàn Quốc' => '🇰🇷',
        'Mỹ' => '🇺🇸',
        'Nhật Bản' => '🇯🇵',
        'Trung Quốc' => '🇨🇳'
    ];
    
    // Mapping hobby với icon
    $hobbyIcons = [
        'Thể thao' => 'fas fa-running',
        'Âm nhạc' => 'fas fa-music',
        'Nghệ thuật' => 'fas fa-palette'
    ];
    ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Success Header -->
                <div class="text-center mb-4">
                    <i class="fas fa-check-circle success-icon"></i>
                    <h2 class="mt-3" style="color: #28a745; font-weight: 700;">Đăng Ký Thành Công!</h2>
                    <p class="text-muted">Thông tin của bạn đã được ghi nhận thành công.</p>
                </div>
                
                <!-- User Info Card -->
                <div class="user-card">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Username -->
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user"></i> Tên người dùng
                                </div>
                                <div class="info-value">
                                    <i class="fas fa-id-badge"></i>
                                    <?php echo $username; ?>
                                </div>
                            </div>
                            
                            <!-- Age -->
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-birthday-cake"></i> Tuổi
                                </div>
                                <div class="info-value">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo $age; ?> tuổi
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Country -->
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-globe"></i> Quốc gia
                                </div>
                                <div class="info-value">
                                    <span style="font-size: 24px;">
                                        <?php echo $countryFlags[$country] ?? '🌍'; ?>
                                    </span>
                                    <?php echo $country; ?>
                                </div>
                            </div>
                            
                            <!-- Registration Time -->
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-clock"></i> Thời gian đăng ký
                                </div>
                                <div class="info-value">
                                    <i class="fas fa-calendar-check"></i>
                                    <?php echo date('d/m/Y H:i:s'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hobbies -->
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-heart"></i> Sở thích
                        </div>
                        <div class="info-value">
                            <?php if (empty($hobbies)): ?>
                                <span style="opacity: 0.7;">
                                    <i class="fas fa-minus"></i> Chưa chọn sở thích nào
                                </span>
                            <?php else: ?>
                                <div>
                                    <?php foreach ($hobbies as $hobby): ?>
                                        <span class="hobby-badge">
                                            <i class="<?php echo $hobbyIcons[$hobby] ?? 'fas fa-star'; ?>"></i>
                                            <?php echo $hobby; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons text-center">
                        <a href="index.php" class="btn btn-back btn-custom">
                            <i class="fas fa-arrow-left"></i> Quay lại Form
                        </a>
                    </div>
                </div>
                
                <!-- Additional Info -->
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="fas fa-info-circle text-info"></i>
                            Bước tiếp theo
                        </h5>
                        <p class="card-text text-muted">
                            Thông tin đăng ký của bạn đã được lưu thành công. 
                            Bạn có thể quay lại để đăng ký thêm người dùng khác.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printInfo() {
            window.print();
        }
        
        // Auto scroll to top
        window.scrollTo(0, 0);
        
        // Add some interactive effects
        document.querySelectorAll('.info-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>