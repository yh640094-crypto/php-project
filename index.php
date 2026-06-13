<?php
include 'config/database.php';
include 'config/functions.php';
?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron bg-light p-5 rounded">
                <h1 class="display-4">Welcome to Hotel Booking System</h1>
                <p class="lead">Discover the best hotels and rooms at affordable prices</p>
                <?php if (!isLoggedIn()): ?>
                    <a class="btn btn-primary btn-lg me-2" href="register.php" role="button">Register Now</a>
                    <a class="btn btn-secondary btn-lg" href="login.php" role="button">Login</a>
                <?php else: ?>
                    <a class="btn btn-primary btn-lg" href="rooms.php" role="button">Browse Rooms</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-bed fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Luxury Rooms</h5>
                    <p class="card-text">Browse our selection of premium and comfortable rooms</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Safe Booking</h5>
                    <p class="card-text">100% secure and reliable booking system</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-star fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Reviews</h5>
                    <p class="card-text">Read reviews from previous guests</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>