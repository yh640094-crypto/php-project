<?php
include 'config/auth.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام حجز الفنادق</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-hotel"></i> نظام حجز الفنادق
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isLoggedIn()): ?>
                    <?php if (isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">لوحة التحكم</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin/rooms.php">الغرف</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin/bookings.php">الحجوزات</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="user/dashboard.php">حجوزاتي</a></li>
                        <li class="nav-item"><a class="nav-link" href="rooms.php">الغرف</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">تسجيل الخروج</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">تسجيل الدخول</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">التسجيل</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main>