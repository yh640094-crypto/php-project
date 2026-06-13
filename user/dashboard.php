<?php
include '../config/database.php';
include '../config/functions.php';
requireLogin();

if (isAdmin()) {
    header('Location: admin/dashboard.php');
    exit();
}

$user_id = getCurrentUser();
$user = getUserById($conn, $user_id);
$bookings = getBookingsByUser($conn, $user_id);
?>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">معلومات الحساب</h5>
                </div>
                <div class="card-body">
                    <p><strong>الاسم:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>البريد الإلكتروني:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>رقم الجوال:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                    <p><strong>تاريخ التسجيل:</strong> <?php echo formatDate($user['created_at']); ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h2 class="mb-4">حجوزاتي</h2>
            
            <?php if (empty($bookings)): ?>
                <div class="alert alert-info">
                    لا توجد حجوزات حالياً. <a href="../rooms.php">ابدأ بالحجز الآن</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>الغرفة</th>
                                <th>تاريخ الدخول</th>
                                <th>تاريخ الخروج</th>
                                <th>السعر الإجمالي</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                                    <td><?php echo formatDate($booking['check_in']); ?></td>
                                    <td><?php echo formatDate($booking['check_out']); ?></td>
                                    <td><?php echo formatCurrency($booking['total_price']); ?></td>
                                    <td>
                                        <span class="badge bg-success"><?php echo htmlspecialchars($booking['status']); ?></span>
                                    </td>
                                    <td>
                                        <a href="../room-details.php?id=<?php echo $booking['room_id']; ?>" class="btn btn-sm btn-info">التفاصيل</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>