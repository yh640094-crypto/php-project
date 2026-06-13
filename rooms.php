<?php
include 'config/database.php';
include 'config/functions.php';
requireLogin();

$rooms = getAllRooms($conn);
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Available Rooms</h2>
    
    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="assets/images/<?php echo htmlspecialchars($room['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($room['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($room['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($room['description']); ?></p>
                        <p class="card-text">
                            <strong>Type:</strong> <?php echo htmlspecialchars($room['type']); ?><br>
                            <strong>Capacity:</strong> <?php echo $room['capacity']; ?> persons<br>
                            <strong>Price per Night:</strong> <span class="text-success">$<?php echo number_format($room['price'], 2); ?></span>
                        </p>
                        <?php $avg_rating = getAverageRating($conn, $room['id']); ?>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i> <?php echo $avg_rating; ?>/5 (ratings)
                        </div>
                        <a href="room-details.php?id=<?php echo $room['id']; ?>" class="btn btn-primary w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>