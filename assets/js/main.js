// Main JavaScript File

// Set minimum checkout date to today
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    
    if (checkInInput) {
        checkInInput.setAttribute('min', today);
    }
    
    if (checkOutInput) {
        checkOutInput.setAttribute('min', today);
    }
    
    // Update checkout minimum when checkin date changes
    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            checkOutInput.setAttribute('min', this.value);
        });
    }
});

// Validate form before submit
function validateForm() {
    const checkIn = document.getElementById('check_in')?.value;
    const checkOut = document.getElementById('check_out')?.value;
    
    if (checkIn && checkOut) {
        if (new Date(checkIn) >= new Date(checkOut)) {
            alert('تاريخ الخروج يجب أن يكون بعد تاريخ الدخول');
            return false;
        }
    }
    return true;
}

// Format currency display
function formatPrice(price) {
    return new Intl.NumberFormat('ar-SA', {
        style: 'currency',
        currency: 'SAR'
    }).format(price);
}