<div align="right">

# 🌟 منصة كفاءات | Kafaat Platform

منصة ويب احترافية لإنشاء وعرض السير الذاتية والملفات المهنية للكفاءات والموظفين، مبنية على **Laravel 12**، مع لوحتي تحكم منفصلتين (للكفاءة ولمسؤول النظام) وواجهة عامة لعرض الكفاءات وتقييمها والتواصل معها.

> A professional platform for building and showcasing CVs / professional profiles for experts ("Kafaa") and employees — built with Laravel 12, featuring separate Expert and Admin dashboards, a public showcase, reviews, and contact messaging.

</div>

---

## 📋 المحتويات

- [نظرة عامة](#-نظرة-عامة)
- [أبرز الميزات](#-أبرز-الميزات)
- [الأدوار والصلاحيات](#-الأدوار-والصلاحيات)
- [التقنيات المستخدمة](#-التقنيات-المستخدمة)
- [متطلبات التشغيل](#-متطلبات-التشغيل)
- [خطوات التثبيت](#-خطوات-التثبيت)
- [بنية المشروع](#-بنية-المشروع)
- [قاعدة البيانات](#-قاعدة-البيانات)
- [أهم المسارات (Routes)](#-أهم-المسارات-routes)
- [الترخيص](#-الترخيص)

---

## 🔎 نظرة عامة

**كفاءات** منصة تتيح لأصحاب الكفاءات والموظفين إنشاء صفحة مهنية كاملة تتضمن نبذتهم، مهاراتهم، لغاتهم، مسمياتهم الوظيفية، خبراتهم، مشاريعهم، وخدماتهم؛ بينما يمكن للزوار تصفح أفضل الكفاءات، الاطلاع على ملفاتهم، إرسال آرائهم وتقييماتهم، والتواصل عبر نموذج المراسلة. يدير النظام بالكامل مسؤول نظام يتحكم بالمستخدمين والمحتوى والإحصائيات.

النظام يتكوّن من **ثلاث واجهات رئيسية**:

| الواجهة | الوصف |
|---------|--------|
| 🌐 **الواجهة العامة (Client)** | الصفحة الرئيسية، أفضل الكفاءات، صفحة الكفاءة العامة، الخدمات، الآراء، تواصل معنا |
| 👤 **لوحة الكفاءة (Kafaa Dashboard)** | لوحة تحكم للكفاءة/الموظف لإدارة سيرته الذاتية بالكامل |
| 🛡️ **لوحة مسؤول النظام (Admin Dashboard)** | تحكم كامل بالمستخدمين والمحتوى والإحصائيات والتفاعل |

---

## ✨ أبرز الميزات

### 🌐 الواجهة العامة
- صفحة رئيسية تعرض الكفاءات المتاحة (`is_available`).
- صفحة ملف عام لكل كفاءة تعرض: النبذة، التخصص، المهارات (مع أشرطة تقدّم حسب المستوى)، اللغات، المسميات الوظيفية، الشهادات، الخبرات (Timeline)، الخدمات، والمشاريع.
- نظام **آراء وتقييمات** (نجوم 1–5) قابل للربط بكفاءة محددة.
- نموذج **تواصل معنا** يحفظ الرسائل في قاعدة البيانات.
- تتبّع **زيارات الصفحات** (Profile Visits) مع تمييز الزائر المسجّل عن غير المسجّل.

### 👤 لوحة الكفاءة
- لوحة تحكم عصرية (RTL) بإحصائيات شخصية وإجراءات سريعة.
- إدارة كاملة (CRUD) لـ: **المشاريع، المهارات، اللغات، المسميات الوظيفية، الخبرات، الخدمات، المنشورات**.
- تعديل **الملف الشخصي** (الاسم، التخصص، النبذة، الهاتف، الموقع، صورة الملف).
- زر **تفعيل/إخفاء الظهور** في الصفحة الرئيسية.
- معاينة الملف العام مباشرة.

### 🛡️ لوحة مسؤول النظام
- **لوحة إحصائيات شاملة:**
  - تحليل المستخدمين (الإجمالي / المسؤولون / الكفاءات والموظفون / العاديون).
  - **النشاط المباشر**: عدد الجلسات النشطة، المتصلون الآن، تمييز **المسجّلين** عن **الزوار** (عبر جدول `sessions`).
  - **تحليل الزيارات**: اليوم / الأسبوع / الإجمالي، وزيارات المسجّلين مقابل غير المسجّلين.
  - عدّادات المشاريع، المهارات، اللغات، المسميات، المنشورات، الآراء، والرسائل.
  - جداول **أحدث**: المستخدمين، الآراء، رسائل التواصل، والزيارات.
- **تحكم كامل (CRUD)** بـ: المستخدمين (مع التحكم بالدور ونوع الحساب)، المشاريع، المهارات، اللغات، المسميات الوظيفية، المنشورات.
- **إدارة الآراء** (عرض/حذف + متوسط التقييم).
- **صندوق رسائل التواصل** (عرض/حذف + الرد عبر البريد).

### 🔐 المصادقة
- تسجيل / دخول / خروج.
- **توجيه تلقائي حسب الدور** (Role-based redirect) عبر `RoleMiddleware`:
  - مسؤول → لوحة الأدمن.
  - كفاءة/موظف → لوحة الكفاءة.
  - مستخدم عادي → الصفحة الرئيسية.

---

## 👥 الأدوار والصلاحيات

| العمود | القيم الممكنة |
|--------|----------------|
| `role` | `user` · `admin` · `super admin` |
| `account_type` | `user` · `kafaa` · `employee` |

- **المسؤول (admin / super admin):** وصول كامل عبر مجموعة مسارات `admin.*` المحمية بـ `role:admin`.
- **الكفاءة/الموظف (kafaa / employee):** وصول للوحة الكفاءة عبر مجموعة `kafaa.*` المحمية بـ `role:kafaa,employee` — كل عملية مقيّدة بـ `Auth::id()`.
- **المستخدم العادي:** تصفح الواجهة العامة فقط.

---

## 🛠️ التقنيات المستخدمة

| الفئة | التقنية |
|-------|----------|
| الإطار (Backend) | **Laravel 12** (PHP ^8.2) |
| قاعدة البيانات | **MySQL** (الاسم الافتراضي: `cv_master`) |
| محرك القوالب | **Blade** (RTL / دعم كامل للعربية) |
| الواجهة (Frontend) | Bootstrap 4.5 + Bootstrap Material Design 4.1 |
| الأيقونات | Font Awesome · Boxicons |
| التأثيرات | Animate.css · Toastr |
| الجلسات | **Database session driver** (جدول `sessions`) |
| التخزين | روابط رمزية `public/storage` لرفع الصور |

ألوان الهوية: البنفسجي الأساسي `#892CDC` · الفاتح `#BC6FF1` · الداكن `#2D114E`.

---

## ⚙️ متطلبات التشغيل

- PHP **8.2** أو أحدث
- Composer
- MySQL / MariaDB (مثلاً عبر XAMPP)
- Node.js + npm (اختياري لبناء الأصول)

---

## 🚀 خطوات التثبيت

```bash
# 1) استنساخ المشروع
git clone https://github.com/Basem-Munassar/Kafaat-Platform-website.git
cd Kafaat-Platform-website

# 2) تثبيت الاعتماديات
composer install
npm install            # اختياري

# 3) إعداد ملف البيئة
cp .env.example .env
php artisan key:generate

# 4) ضبط قاعدة البيانات في .env
# DB_DATABASE=cv_master
# DB_USERNAME=root
# DB_PASSWORD=

# 5) تشغيل الهجرات
php artisan migrate

# 6) ربط مجلد التخزين (لرفع الصور)
php artisan storage:link

# 7) تشغيل الخادم
php artisan serve
```

ثم افتح: `http://127.0.0.1:8000`

> ملاحظة: على ويندوز/XAMPP قد تحتاج لمسار PHP الكامل مثل `C:\xampp\php\php.exe artisan ...`.

---

## 🗂️ بنية المشروع

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── dashboardController.php     # لوحتا الأدمن والكفاءة + الملف الشخصي
│   │   ├── usersController.php         # إدارة المستخدمين (admin)
│   │   ├── projectsController.php      # مشاريع (admin + kafaa)
│   │   ├── skillsController.php        # مهارات
│   │   ├── languagesController.php     # لغات
│   │   ├── jobsController.php          # مسميات وظيفية
│   │   ├── postsController.php         # منشورات
│   │   ├── ExperienceController.php    # خبرات (kafaa)
│   │   ├── ServiceController.php       # خدمات (kafaa)
│   │   ├── ReviewController.php        # آراء (عامة + إدارة)
│   │   ├── ContactController.php       # رسائل التواصل (عامة + إدارة)
│   │   ├── KafaaController.php         # الصفحة العامة للكفاءة + تتبّع الزيارات
│   │   └── auth/authController.php     # المصادقة + التوجيه حسب الدور
│   └── Middleware/RoleMiddleware.php   # حماية المسارات حسب الدور
├── Models/  (User, Kafaa, Project, Skill, Language, JobTitle, Experience,
│             Service, BlogPost, Review, ProfileVisit, ContactMessage, ...)
resources/views/
├── client/   # الواجهة العامة
├── kafaa/    # لوحة الكفاءة (layout + dashboard + pages + add&Edit)
└── admin/    # لوحة المسؤول (layout + dashboard + pages + add&Edit)
routes/web.php
database/migrations/
```

---

## 🗄️ قاعدة البيانات

أهم الجداول:

| الجدول | أبرز الأعمدة |
|--------|---------------|
| `users` | name, email, password, phone, location, bio, specialty, profile_image, **role**, **account_type**, **is_available** |
| `projects` | user_id, title, description, technologies, link, image, date |
| `skills` | user_id, name, level, category |
| `languages` | user_id, language, level |
| `job_titles` | user_id, title, description |
| `experiences` | user_id, title, company, start_date, end_date, is_current, description |
| `services` | user_id, title, description, icon |
| `blog_posts` | title, content, slug, date, posterName, posterEmail |
| `reviews` | profile_user_id, name, rating, comment, image |
| `profile_visits` | profile_user_id, visitor_user_id, visitor_ip |
| `contact_messages` | name, email, subject, message |
| `sessions` | id, user_id, ip_address, user_agent, last_activity |

---

## 🧭 أهم المسارات (Routes)

```
# عام
GET  /                         home.index
GET  /profile/{id}             kafaa.show          (الصفحة العامة للكفاءة)
GET  /reviews · POST /reviews  client.reviews · reviews.store
GET  /contact · POST /contact  client.contact · contact.store

# المصادقة
GET  /login · /auth/register · POST /auth/store · /auth/logout

# مسؤول النظام  (prefix: admin/ · middleware: role:admin)
GET  /admin/dashboard          admin.dashboard.index
.../users · projects · skills · languages · jobsTitle · posts   (CRUD كامل)
GET  /admin/reviews · DELETE /admin/reviews/delete/{id}
GET  /admin/messages · DELETE /admin/messages/delete/{id}

# الكفاءة  (prefix: kafaa/ · middleware: role:kafaa,employee)
GET  /kafaa/dashboard          kafaa.dashboard.index
.../projects · skills · languages · jobsTitle · experiences · services · posts  (CRUD)
GET  /kafaa/profile/edit · PUT /kafaa/profile/update
POST /kafaa/toggle-availability
```

---

## 📄 الترخيص

تم بناء هذا المشروع باستخدام إطار **Laravel** المرخّص بموجب [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

© جميع الحقوق محفوظة للمهندس **باسم عبدالرحمن صالح منصر**

</div>
