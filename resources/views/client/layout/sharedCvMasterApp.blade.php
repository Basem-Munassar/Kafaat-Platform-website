<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>السيرة الذاتية | كفاءات</title>
    <!--=========== link cdnjs ============ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!--======== link style =========-->
    <link rel="stylesheet" href="{{ asset('client/style.css') }}">
    <!--======== link icons ===========-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== Clean shared-CV brand bar (no navigation) ===== */
        .kfa-share-bar {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            height: 64px;
            background: linear-gradient(135deg, #2d114e 0%, #892CDC 60%, #BC6FF1 100%);
            box-shadow: 0 4px 18px rgba(45, 17, 78, .25);
        }
        .kfa-share-bar__logo {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: #fff;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: .5px;
            text-decoration: none;
        }
        .kfa-share-bar__logo i {
            font-size: 1.7rem;
            color: #fff;
            background: rgba(255, 255, 255, .18);
            border-radius: 10px;
            padding: 4px 8px;
        }
        .kfa-share-foot {
            text-align: center;
            padding: 18px 12px;
            color: #8a7aa8;
            font-size: .85rem;
            background: #f4f1fa;
        }
        .kfa-share-foot strong { color: #892CDC; }
    </style>
</head>

<body>
    <!--==================== STYLE SWITCHER (hidden inputs keep default theming) ====================-->
    <input type="radio" name="color" id="color-1">
    <input type="radio" name="color" id="color-2">
    <input type="radio" name="color" id="color-3">
    <input type="radio" name="color" id="color-4">
    <input type="radio" name="color" id="color-5">
    <input type="radio" name="color" id="color-6">
    <input type="radio" name="color" id="color-7">
    <input type="radio" name="color" id="color-8">
    <input type="radio" name="color" id="color-9">
    <input type="radio" name="color" id="color-10">

    <!--================== Brand bar (Kafaat logo only) ============-->
    <header class="kfa-share-bar">
        <span class="kfa-share-bar__logo">
            <i class='bx bxs-graduation'></i> كفاءات
        </span>
    </header>

    <!------------------------------ start main ------------------------------------->
    <main class="main">
        @yield('Home')
    </main>
    <!------------------------------ end main --------------------------------------->

    <footer class="kfa-share-foot">
        تم إنشاء هذه السيرة الذاتية ومشاركتها عبر منصة <strong>كفاءات</strong>
    </footer>

    <!--============ link script ================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{ asset('client/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
