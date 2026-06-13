<?php
include '../config/database.php';
include '../config/functions.php';
requireAdmin();

$bookings = getAllBookings($conn);
?>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">إدارة الحجوزات</h2>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم العميل</th>
                    <th>البريد الإلكتروني</th>
                    <th>الغرفة</th>
                    <th>تاريخ الدخول</th>
                    <th>تاريخ الخروج</th>
                    <th>السعر الإجمالي</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['email']); ?></td>
                        <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                        <td><?php echo formatDate($booking['check_in']); ?></td>
                        <td><?php echo formatDate($booking['check_out']); ?></td>
                        <td><?php echo formatCurrency($booking['total_price']); ?></td>
                        <td><span class="badge bg-success"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>