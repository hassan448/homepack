# هوم باك — Laravel Backend

## المتطلبات

- PHP 8.2+ (مع extensions: `zip`, `intl`, `pdo_sqlite`)
- Composer

## التشغيل المحلي

```bash
cd homepack
composer install
php artisan migrate
php artisan serve
```

| الرابط | الوصف |
|--------|--------|
| http://localhost:8000 | الموقع (Laravel default) |
| http://localhost:8000/admin | لوحة الإدارة |

## بيانات الدخول (تجريبي)

| الحقل | القيمة |
|-------|--------|
| البريد | `admin@homepack.com` |
| كلمة المرور | `HomePack@2024` |
| الدور | `مدير النظام` (admin) |

> غيّر كلمة المرور قبل النشر على الإنتاج.

## الأدوار في لوحة التحكم

| الدور | الصلاحيات |
|-------|-----------|
| **مدير النظام** (admin) | كل شيء + إضافة/حذف المستخدمين |
| **مدير المحتوى** (content) | المنتجات، الفئات، الصفحات، الإعدادات |
| **مدير الطلبات** (orders) | الطلبات فقط |

> فقط **مدير النظام** يرى قسم «المستخدمون» ويستطيع إضافة أو حذف حسابات.

## هيكل المجلدات

```
homepack/          ← مشروع Laravel (الجديد)
index.html         ← الموقع الثابت (مرجع للتصميم)
IMPLEMENTATION.md  ← خطة التنفيذ
LOG.md             ← سجل التقدم
```

## التقنيات

- Laravel 12
- Filament 5 (لوحة إدارة عربية)
- SQLite (تطوير) → MySQL (إنتاج)

## ملاحظات PHP (XAMPP)

تأكد من تفعيل في `C:\xampp\php\php.ini`:

```ini
extension=zip
extension=intl
```
