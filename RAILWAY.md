# نشر موقع هوم باك على Railway

> الكود على GitHub: https://github.com/hassan5580/homepack

---

## الخطوة 1 — إنشاء حساب Railway

1. ادخل [railway.com](https://railway.com) وسجّل بحساب GitHub
2. قد يطلب تحقق بالبطاقة (تفويض مؤقت ~$1 — لا يُخصم)

---

## الخطوة 2 — مشروع جديد + قاعدة بيانات

1. **New Project**
2. **Deploy PostgreSQL** (أو: Empty Project → **+ New** → **Database** → **PostgreSQL**)
3. انتظر حتى تظهر قاعدة البيانات ✅

---

## الخطوة 3 — ربط GitHub

1. في نفس المشروع: **+ New** → **GitHub Repo**
2. اختر **`hassan5580/homepack`**
3. Railway يكتشف `Dockerfile` و `railway.toml` تلقائياً

---

## الخطوة 4 — متغيرات البيئة (مهم)

افتح خدمة **homepack** (الويب) → **Variables** → **Raw Editor** والصق:

```env
APP_NAME=هوم باك
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:5SXmR31M53lIWjFJC8LuUMlaW9NByadForEjjTeJjaQ=
APP_URL=https://YOUR-APP.up.railway.app
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=pgsql
DB_URL=${{Postgres.DATABASE_URL}}

SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public

ADMIN_NAME=مدير النظام
ADMIN_EMAIL=admin@homepack.com
ADMIN_PASSWORD=ضع-كلمة-مرور-قوية-هنا
```

> **ملاحظة:** إذا اسم خدمة PostgreSQL عندك مش `Postgres`، غيّر المرجع — مثلاً `${{PostgreSQL.DATABASE_URL}}`.  
> اسمه يظهر على البطاقة في لوحة المشروع.

---

## الخطوة 5 — رابط عام (Domain)

1. خدمة الويب → **Settings** → **Networking**
2. **Generate Domain**
3. انسخ الرابط (مثل `https://homepack-production-xxxx.up.railway.app`)
4. ارجع **Variables** وحدّث `APP_URL` بنفس الرابط
5. **Deploy** أو انتظر إعادة النشر التلقائية

---

## الخطوة 6 — انتظر البناء

- أول build: **5–10 دقائق**
- من **Deployments** → **View Logs** تتابع:
  - `Running migrations...`
  - `Seeding database...`
  - `Starting server on port...`

---

## بعد النشر

| الرابط | الوصف |
|--------|--------|
| `https://your-app.up.railway.app` | الموقع |
| `https://your-app.up.railway.app/admin` | لوحة التحكم |
| `https://your-app.up.railway.app/up` | فحص الصحة |

| الحقل | القيمة |
|-------|--------|
| البريد | `admin@homepack.com` |
| كلمة المرور | اللي حطيتها في `ADMIN_PASSWORD` |

---

## استكشاف الأخطاء

| المشكلة | الحل |
|---------|------|
| Build فشل | راجع Logs — غالباً npm أو composer |
| 500 بعد النشر | تأكد `APP_KEY` و `DB_URL` و `DB_CONNECTION=pgsql` |
| DB connection failed | تأكد `${{Postgres.DATABASE_URL}}` يطابق اسم خدمة PostgreSQL |
| CSS مش ظاهر | حدّث `APP_URL` بالرابط الصحيح وأعد Deploy |

---

## تحديث الموقع لاحقاً

```powershell
cd "D:\home pack\homepack"
git add .
git commit -m "تحديث الموقع"
git push
```

Railway يعيد النشر تلقائياً عند كل push على `main`.
