# Hotel Booking System

A complete hotel booking system built with PHP and MySQL with admin and user dashboards.

## Features

### For Users
- ✅ User registration and secure login
- ✅ Browse available rooms
- ✅ View room details (images, description, amenities)
- ✅ Book rooms by selecting check-in and check-out dates
- ✅ Add reviews and ratings
- ✅ View booking history
- ✅ Personal dashboard

### For Admin
- 🔐 Admin dashboard with statistics
- 📊 View total rooms, bookings, users, and revenue
- 🏠 Manage rooms (add, view)
- 📋 Manage all bookings
- 👥 View all users

## Technologies Used

- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **JavaScript:** Vanilla JS
- **Security:** Password Hashing, Input Sanitization, SQL Injection Prevention

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web Server (Apache, Nginx)

## Installation

### 1. Create Database
```bash
mysql -u root -p < database.sql
```

### 2. Update Database Configuration
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_booking');
```

### 3. Create Images Directory
```bash
mkdir -p assets/images
chmod 755 assets/images
```

### 4. Run the Application
```bash
cd php-project
php -S localhost:8000
```

Then open: `http://localhost:8000`

## Test Accounts

### Admin Account
- Email: `admin@hotel.com`
- Password: `admin123`

## Project Structure

```
php-project/
├── config/
│   ├── database.php      # Database configuration
│   ├── auth.php          # Authentication functions
│   └── functions.php     # Helper functions
├── admin/
│   ├── dashboard.php     # Admin dashboard
│   ├── rooms.php         # Manage rooms
│   └── bookings.php      # Manage bookings
├── user/
│   └── dashboard.php     # User dashboard
├── includes/
│   ├── header.php        # Page header
│   └── footer.php        # Page footer
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── images/           # Room images
├── index.php             # Home page
├── register.php          # Registration
├── login.php             # Login
├── logout.php            # Logout
├── rooms.php             # Browse rooms
├── room-details.php      # Room details & booking
└── database.sql          # SQL file
```

## Security Features

✅ Password hashing using `password_hash`
✅ Input validation and sanitization
✅ Protection against SQL Injection using Prepared Statements
✅ Secure session management
✅ User authorization checks

## License

This project is licensed under the MIT License.

---

**Thank you for using Hotel Booking System!**