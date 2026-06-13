<?php
include '../config/database.php';
include '../config/functions.php';
requireAdmin();

$bookings = getAllBookings($conn);
?>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Manage Bookings</h2>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Guest Name</th>
                    <th>Email</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['email']); ?></td>
                        <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($booking['check_in'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($booking['check_out'])); ?></td>
                        <td>$<?php echo number_format($booking['total_price'], 2); ?></td>
                        <td><span class="badge bg-success"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>