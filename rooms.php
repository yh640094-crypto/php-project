<?php
include 'config/database.php';
include 'config/functions.php';
requireLogin();

$rooms = getAllRooms($conn);
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">الغرف المتاحة</h2>
    
    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="assets/images/<?php echo htmlspecialchars($room['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($room['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($room['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($room['description']); ?></p>
                        <p class="card-text">
                            <strong>النوع:</strong> <?php echo htmlspecialchars($room['type']); ?><br>
                            <strong>السعة:</strong> <?php echo $room['capacity']; ?> أشخاص<br>
                            <strong>السعر (الليلة):</strong> <span class="text-success"><?php echo formatCurrency($room['price']); ?></span>
                        </p>
                        <?php $avg_rating = getAverageRating($conn, $room['id']); ?>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i> <?php echo $avg_rating; ?>/5 (تقييم)
                        </div>
                        <a href="room-details.php?id=<?php echo $room['id']; ?>" class="btn btn-primary w-100">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>