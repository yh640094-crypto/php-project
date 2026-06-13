<?php
// Helper Functions

// Sanitize input
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Get user by ID
function getUserById($conn, $user_id) {
    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Get user by email
function getUserByEmail($conn, $email) {
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Format date
function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

// Format currency
function formatCurrency($amount) {
    return number_format($amount, 2) . ' ريال';
}

// Calculate nights
function calculateNights($checkIn, $checkOut) {
    $start = new DateTime($checkIn);
    $end = new DateTime($checkOut);
    return $end->diff($start)->days;
}

// Get all rooms
function getAllRooms($conn) {
    $query = 'SELECT * FROM rooms WHERE status = "available" ORDER BY price';
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Get room by ID
function getRoomById($conn, $room_id) {
    $stmt = $conn->prepare('SELECT * FROM rooms WHERE id = ?');
    $stmt->bind_param('i', $room_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Get bookings by user
function getBookingsByUser($conn, $user_id) {
    $stmt = $conn->prepare('SELECT b.*, r.name, r.image FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.user_id = ? ORDER BY b.check_in DESC');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Get all bookings (admin)
function getAllBookings($conn) {
    $query = 'SELECT b.*, u.name as user_name, u.email, r.name as room_name FROM bookings b JOIN users u ON b.user_id = u.id JOIN rooms r ON b.room_id = r.id ORDER BY b.check_in DESC';
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

// Create booking
function createBooking($conn, $user_id, $room_id, $check_in, $check_out, $total_price) {
    $stmt = $conn->prepare('INSERT INTO bookings (user_id, room_id, check_in, check_out, total_price, status) VALUES (?, ?, ?, ?, ?, "confirmed")');
    $stmt->bind_param('iissd', $user_id, $room_id, $check_in, $check_out, $total_price);
    return $stmt->execute();
}

// Add review
function addReview($conn, $user_id, $room_id, $rating, $comment) {
    $stmt = $conn->prepare('INSERT INTO reviews (user_id, room_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())');
    $stmt->bind_param('iiis', $user_id, $room_id, $rating, $comment);
    return $stmt->execute();
}

// Get reviews for room
function getReviewsByRoom($conn, $room_id) {
    $stmt = $conn->prepare('SELECT r.*, u.name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.room_id = ? ORDER BY r.created_at DESC');
    $stmt->bind_param('i', $room_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Get average rating
function getAverageRating($conn, $room_id) {
    $stmt = $conn->prepare('SELECT AVG(rating) as avg_rating FROM reviews WHERE room_id = ?');
    $stmt->bind_param('i', $room_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['avg_rating'] ? round($result['avg_rating'], 1) : 0;
}

?>