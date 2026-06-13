<?php
include 'config/database.php';
include 'config/functions.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = sanitize($_POST['phone'] ?? '');
    
    if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        $error = 'جميع الحقول مطلوبة';
    } elseif (!validateEmail($email)) {
        $error = 'البريد الإلكتروني غير صحيح';
    } elseif (strlen($password) < 6) {
        $error = 'كلمة المرور يجب أن تكون 6 أحرف على الأقل';
    } elseif ($password !== $confirm_password) {
        $error = 'كلمات المرور غير متطابقة';
    } else {
        $existingUser = getUserByEmail($conn, $email);
        if ($existingUser) {
            $error = 'البريد الإلكتروني موجود بالفعل';
        } else {
            $hashed_password = hashPassword($password);
            $stmt = $conn->prepare('INSERT INTO users (name, email, password, phone, role, created_at) VALUES (?, ?, ?, ?, "user", NOW())');
            $stmt->bind_param('ssss', $name, $email, $hashed_password, $phone);
            
            if ($stmt->execute()) {
                $success = 'تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول';
            } else {
                $error = 'حدث خطأ أثناء التسجيل';
            }
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">إنشاء حساب جديد</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الجوال</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">التسجيل</button>
                    </form>
                    <p class="mt-3 text-center">
                        هل لديك حساب؟ <a href="login.php">تسجيل الدخول</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>