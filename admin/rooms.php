<?php
include '../config/database.php';
include '../config/functions.php';
requireAdmin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = sanitize($_POST['name'] ?? '');
        $type = sanitize($_POST['type'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $capacity = (int)($_POST['capacity'] ?? 0);
        $description = sanitize($_POST['description'] ?? '');
        $amenities = sanitize($_POST['amenities'] ?? '');
        $image = 'default.jpg';
        
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $upload_dir = '../assets/images/';
            $image_name = uniqid() . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);
            $image = $image_name;
        }
        
        if (empty($name) || empty($type) || $price <= 0 || $capacity <= 0) {
            $error = 'جميع الحقول مطلوبة';
        } else {
            $stmt = $conn->prepare('INSERT INTO rooms (name, type, price, capacity, description, amenities, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, "available")');
            $stmt->bind_param('ssidiss', $name, $type, $price, $capacity, $description, $amenities, $image);
            
            if ($stmt->execute()) {
                $success = 'تم إضافة الغرفة بنجاح';
            } else {
                $error = 'حدث خطأ أثناء إضافة الغرفة';
            }
        }
    }
}

$rooms = getAllRooms($conn);
?>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">إدارة الغرف</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">إضافة غرفة جديدة</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">اسم الغرفة</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">نوع الغرفة</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">اختر النوع</option>
                            <option value="فردية">فردية</option>
                            <option value="مزدوجة">مزدوجة</option>
                            <option value="عائلية">عائلية</option>
                            <option value="ملكية">ملكية</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">السعر (الليلة)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="capacity" class="form-label">السعة (عدد الأشخاص)</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="amenities" class="form-label">المرافق</label>
                    <textarea class="form-control" id="amenities" name="amenities" rows="2" placeholder="Wi-Fi، تلفاز، حمام خاص، إلخ"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">صورة الغرفة</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">إضافة الغرفة</button>
            </form>
        </div>
    </div>
    
    <h4 class="mb-3">الغرف الموجودة</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>النوع</th>
                    <th>السعة</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room['name']); ?></td>
                        <td><?php echo htmlspecialchars($room['type']); ?></td>
                        <td><?php echo $room['capacity']; ?></td>
                        <td><?php echo formatCurrency($room['price']); ?></td>
                        <td><span class="badge bg-success"><?php echo htmlspecialchars($room['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>