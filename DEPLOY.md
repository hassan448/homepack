# نشر موقع هوم باك على Render.com

## المتطلبات

- حساب مجاني على [GitHub](https://github.com)
- حساب مجاني على [Render.com](https://render.com)
- Git مثبت على جهازك

---

## الخطوة 1 — رفع الكود على GitHub

افتح Terminal في مجلد `homepack`:

```bash
cd "D:\home pack\homepack"

# إنشاء repo جديد (لو المجلد مربوط بـ laravel/laravel احذف .git أولاً)
# rmdir /s /q .git   ← Windows (اختياري)

git init
git add .
git commit -m "Home Pack — Laravel + Filament ready for deploy"

# أنشئ repo فارغ على GitHub باسم homepack (بدون README)
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/homepack.git
git push -u origin main
```

> استبدل `YOUR_USERNAME` باسم حسابك على GitHub.

---

## الخطوة 2 — النشر على Render

1. ادخل [dashboard.render.com](https://dashboard.render.com)
2. **New +** → **Blueprint**
3. اربط حساب GitHub واختر repo `homepack`
4. Render يقرأ ملف `render.yaml` تلقائياً
5. اضغط **Apply**

---

## الخطوة 3 — متغيرات البيئة (مهم)

بعد بدء النشر، من **Environment** في خدمة `homepack`:

| المتغير | القيمة |
|---------|--------|
| `APP_URL` | `https://homepack-xxxx.onrender.com` (رابط Render الفعلي) |
| `ADMIN_PASSWORD` | كلمة مرور قوية للأدمن |

> `APP_KEY` و `DB_URL` يتولّدون تلقائياً من `render.yaml`.

---

## الخطوة 4 — انتظر اكتمال البناء

- أول build قد يستغرق **5–10 دقائق**
- عند النجاح: ✅ **Live**

| الرابط | الوصف |
|--------|--------|
| `https://your-app.onrender.com` | الموقع |
| `https://your-app.onrender.com/admin` | لوحة التحكم |
| `https://your-app.onrender.com/up` | فحص الصحة |

---

## بيانات الدخول (بعد النشر)

| الحقل | القيمة |
|-------|--------|
| البريد | `admin@homepack.com` |
| كلمة المرور | اللي حطيتها في `ADMIN_PASSWORD` |

---

## ملاحظات مهمة

### الخطة المجانية
- السيرفر **ينام** بعد 15 دقيقة بدون زيارات — أول فتح بعدها بطيء (~30 ث)
- قاعدة البيانات PostgreSQL مجانية (1GB)

### الصور والفيدio
- الملفات المرفوعة من الدashboard تُحفظ على قرص مؤقت — **تُمسح عند إعادة النشر**
- للإنتاج الحقيقي: استخدم [Render Disk](https://render.com/docs/disks) أو S3

### تحديث الموقع
```bash
git add .
git commit -m "update"
git push
```
Render يعيد النشر تلقائياً.

---

## استكشاف الأخطاء

| المشكلة | الحل |
|---------|------|
| Build failed | راجع **Logs** في Render → Build |
| 500 error | راجع **Logs** → Runtime، تأكد من `APP_KEY` و `DB_URL` |
| CSS مكسور | تأكد أن `npm run build` نجح في Docker logs |
| Admin لا يعمل | تأكد من `ADMIN_PASSWORD` في Environment |

---

## النشر على Hostinger (لاحقاً)

1. VPS أو Shared Hosting مع PHP 8.2+
2. MySQL/PostgreSQL
3. `composer install --no-dev`
4. `npm ci && npm run build`
5. `php artisan migrate --force && php artisan db:seed --force`
6. اضبط Document Root على `public/`
