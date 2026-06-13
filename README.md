# 🏨 نظام حجز الفنادق - Hotel Booking System

نظام متكامل لحجز الفنادق مبني بـ PHP و MySQL مع واجهة استخدام حديثة وآمنة.

## ✨ المميزات

### للعملاء (Users)
- ✅ تسجيل حساب جديد وتسجيل دخول آمن
- ✅ تصفح الغرف المتاحة
- ✅ عرض تفاصيل الغرفة (الصور، الوصف، المرافق)
- ✅ حجز الغرف باختيار تاريخ الدخول والخروج
- ✅ إضافة تقييمات وآراء حول الغرف
- ✅ عرض حجوزاتهم السابقة
- ✅ لوحة تحكم شخصية

### للإدارة (Admin)
- 🔒 لوحة تحكم متقدمة
- 📊 عرض الإحصائيات (إجمالي الغرف، الحجوزات، الإيرادات)
- 🏠 إدارة الغرف (إضافة، تعديل، حذف)
- 📝 إدارة الحجوزات
- 👥 إدارة المستخدمين

## 🛠️ التقنيات المستخدمة

- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **JavaScript:** Vanilla JS
- **Security:** Password Hashing, Input Sanitization, SQL Injection Prevention

## 📋 المتطلبات

- PHP 7.4 أو أعلى
- MySQL 5.7 أو أعلى
- Web Server (Apache, Nginx)

## 🚀 خطوات التثبيت

### 1. إنشاء قاعدة البيانات
```bash
mysql -u root -p < database.sql
```

### 2. تحديث إعدادات الاتصال
عدّل ملف `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_booking');
```

### 3. إنشاء مجلد الصور
```bash
mkdir -p assets/images
chmod 755 assets/images
```

### 4. تشغيل التطبيق
```bash
cd php-project
php -S localhost:8000
```

ثم افتح المتصفح على: `http://localhost:8000`

## 👤 حسابات التجربة

### Admin Account
- البريد: `admin@hotel.com`
- كلمة المرور: `admin123` (يرجى تغييرها)

## 📁 هيكل المشروع

```
php-project/
├── config/
│   ├── database.php      # إعدادات قاعدة البيانات
│   ├── auth.php          # إدارة المستخدمين
│   └── functions.php     # الدوال المساعدة
├── admin/
│   ├── dashboard.php     # لوحة التحكم
│   ├── rooms.php         # إدارة الغرف
│   └── bookings.php      # إدارة الحجوزات
├── user/
│   └── dashboard.php     # لوحة المستخدم
├── includes/
│   ├── header.php        # رأس الصفحة
│   └── footer.php        # تذييل الصفحة
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── images/           # صور الغرف
├── index.php             # الصفحة الرئيسية
├── register.php          # تسجيل جديد
├── login.php             # تسجيل دخول
├── logout.php            # تسجيل خروج
├── rooms.php             # عرض الغرف
├── room-details.php      # تفاصيل الغرفة
└── database.sql          # نصوص SQL
```

## 🔐 معايير الأمان

✅ تشفير كلمات المرور باستخدام `password_hash`
✅ التحقق من المدخلات (`Input Sanitization`)
✅ حماية من SQL Injection باستخدام `Prepared Statements`
✅ إدارة الجلسات الآمنة (`Session Management`)
✅ التحقق من صلاحيات المستخدمين (`Authorization Checks`)

## 📱 المميزات المتقدمة

- 🌐 دعم اللغة العربية بشكل كامل
- 📱 واجهة مستجيبة (Responsive Design)
- 🎨 تصميم حديث وجذاب
- ⚡ أداء سريع وفعال
- 📊 تقارير وإحصائيات

## 🤝 المساهمة

نرحب بالمساهمات! يرجى:
1. عمل Fork للمشروع
2. إنشاء فرع جديد (`git checkout -b feature/amazing-feature`)
3. الالتزام بالتغييرات (`git commit -m 'Add amazing feature'`)
4. رفع الفرع (`git push origin feature/amazing-feature`)
5. فتح Pull Request

## 📝 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE)

## 👨‍💻 المطور

تم تطويره بواسطة: **PHP Developer**

## 📞 التواصل والدعم

للأسئلة والدعم، يرجى فتح Issue جديدة في المشروع.

---

**شكراً لاستخدامك نظام حجز الفنادق! 🙏**