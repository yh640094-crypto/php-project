<?php
include 'config/database.php';
include 'config/functions.php';
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron bg-light p-5 rounded">
                <h1 class="display-4">أهلا وسهلا بك في نظام حجز الفنادق</h1>
                <p class="lead">اكتشف أفضل الفنادق والغرف الفاخرة بأسعار مناسبة</p>
                <?php if (!isLoggedIn()): ?>
                    <a class="btn btn-primary btn-lg me-2" href="register.php" role="button">سجل الآن</a>
                    <a class="btn btn-secondary btn-lg" href="login.php" role="button">دخول</a>
                <?php else: ?>
                    <a class="btn btn-primary btn-lg" href="rooms.php" role="button">تصفح الغرف</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-bed fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">غرف فاخرة</h5>
                    <p class="card-text">تصفح مختارة من أفضل الغرف الفاخرة</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5 class="card-title">حجز آمن</h5>
                    <p class="card-text">نظام حجز آمن وموثوق 100%</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-star fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">تقييمات</h5>
                    <p class="card-text">اقرأ تقييمات الضيوف السابقين</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>