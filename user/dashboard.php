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
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                    <p><strong>Registration Date:</strong> <?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h2 class="mb-4">My Bookings</h2>
            
            <?php if (empty($bookings)): ?>
                <div class="alert alert-info">
                    No bookings yet. <a href="../rooms.php">Start booking now</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($booking['check_in'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($booking['check_out'])); ?></td>
                                    <td>$<?php echo number_format($booking['total_price'], 2); ?></td>
                                    <td>
                                        <span class="badge bg-success"><?php echo htmlspecialchars($booking['status']); ?></span>
                                    </td>
                                    <td>
                                        <a href="../room-details.php?id=<?php echo $booking['room_id']; ?>" class="btn btn-sm btn-info">Details</a>
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