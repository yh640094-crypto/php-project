<?php
include 'config/database.php';
include 'config/functions.php';
requireLogin();

$room_id = sanitize($_GET['id'] ?? '');

if (empty($room_id)) {
    header('Location: rooms.php');
    exit();
}

$room = getRoomById($conn, $room_id);
if (!$room) {
    header('Location: rooms.php');
    exit();
}

$reviews = getReviewsByRoom($conn, $room_id);
$avg_rating = getAverageRating($conn, $room_id);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'book') {
        $check_in = sanitize($_POST['check_in'] ?? '');
        $check_out = sanitize($_POST['check_out'] ?? '');
        
        if (empty($check_in) || empty($check_out)) {
            $error = 'Check-in and check-out dates are required';
        } else {
            $nights = calculateNights($check_in, $check_out);
            if ($nights <= 0) {
                $error = 'Check-out date must be after check-in date';
            } else {
                $total_price = $nights * $room['price'];
                $user_id = getCurrentUser();
                
                if (createBooking($conn, $user_id, $room_id, $check_in, $check_out, $total_price)) {
                    $success = 'Booking successful!';
                } else {
                    $error = 'Error during booking';
                }
            }
        }
    } elseif ($_POST['action'] === 'review') {
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = sanitize($_POST['comment'] ?? '');
        $user_id = getCurrentUser();
        
        if (empty($rating) || empty($comment)) {
            $error = 'Rating and comment are required';
        } elseif ($rating < 1 || $rating > 5) {
            $error = 'Rating must be between 1 and 5';
        } else {
            if (addReview($conn, $user_id, $room_id, $rating, $comment)) {
                $success = 'Review added successfully';
                header('Refresh:2');
            } else {
                $error = 'Error adding review';
            }
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <img src="assets/images/<?php echo htmlspecialchars($room['image']); ?>" class="img-fluid rounded mb-4" alt="<?php echo htmlspecialchars($room['name']); ?>">
            
            <h1><?php echo htmlspecialchars($room['name']); ?></h1>
            <p class="text-muted mb-4"><?php echo htmlspecialchars($room['description']); ?></p>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Room Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($room['type']); ?></p>
                    <p><strong>Capacity:</strong> <?php echo $room['capacity']; ?> persons</p>
                    <p><strong>Price per Night:</strong> <span class="text-success">$<?php echo number_format($room['price'], 2); ?></span></p>
                    <p><strong>Amenities:</strong> <?php echo htmlspecialchars($room['amenities']); ?></p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Reviews (<?php echo count($reviews); ?>)</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <strong>Average Rating:</strong>
                        <span class="text-warning">
                            <i class="fas fa-star"></i> <?php echo $avg_rating; ?>/5
                        </span>
                    </p>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    
                    <?php foreach ($reviews as $review): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo htmlspecialchars($review['name']); ?></h6>
                                <p class="card-text text-warning">
                                    <?php echo str_repeat('⭐', $review['rating']); ?>
                                </p>
                                <p class="card-text"><?php echo htmlspecialchars($review['comment']); ?></p>
                                <small class="text-muted"><?php echo date('d/m/Y', strtotime($review['created_at'])); ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Book Now</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="book">
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Book Room</button>
                    </form>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Add Review</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="review">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-control" id="rating" name="rating" required>
                                <option value="">Select rating</option>
                                <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                <option value="4">⭐⭐⭐⭐ Very Good</option>
                                <option value="3">⭐⭐⭐ Good</option>
                                <option value="2">⭐⭐ Fair</option>
                                <option value="1">⭐ Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>