<?php
include '../config/database.php';
include '../config/functions.php';
requireAdmin();

$total_rooms = $conn->query('SELECT COUNT(*) as count FROM rooms')->fetch_assoc()['count'];
$total_bookings = $conn->query('SELECT COUNT(*) as count FROM bookings')->fetch_assoc()['count'];
$total_users = $conn->query('SELECT COUNT(*) as count FROM users WHERE role = "user"')->fetch_assoc()['count'];
$total_revenue = $conn->query('SELECT SUM(total_price) as sum FROM bookings')->fetch_assoc()['sum'] ?? 0;
?>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="mb-4">لوحة التحكم</h1>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الغرف</h5>
                    <h2 class="text-primary"><?php echo $total_rooms; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الحجوزات</h5>
                    <h2 class="text-success"><?php echo $total_bookings; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">إجمالي المستخدمين</h5>
                    <h2 class="text-info"><?php echo $total_users; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الإيرادات</h5>
                    <h2 class="text-warning"><?php echo formatCurrency($total_revenue); ?></h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-12">
            <a href="rooms.php" class="btn btn-primary me-2">إدارة الغرف</a>
            <a href="bookings.php" class="btn btn-success">إدارة الحجوزات</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>