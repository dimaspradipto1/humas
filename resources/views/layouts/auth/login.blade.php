<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIHUMAS — Layanan Pengajuan Personil &amp; Alat | Universitas Ibnu Sina</title>
    <meta name="description" content="Sistem Layanan Pengajuan Personil dan Alat Humas Universitas Ibnu Sina">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #C9A84C;
            --gold-light: #F0D080;
            --gold-dark: #A07830;
            --navy: #0A1628;
            --navy-mid: #112240;
            --navy-light: #1A3460;
            --white: #FFFFFF;
            --gray-100: #F8F9FA;
            --gray-400: #9CA3AF;
            --error: #EF4444;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        /* ===== LAYOUT ===== */
        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* ===== LEFT PANEL ===== */
        .panel-left {
            flex: 1.1;
            position: relative;
            background: var(--navy);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .panel-left .bg-img {
            position: absolute;
            inset: 0;
            background: url('/volt/assets/img/uis.png') center/cover no-repeat;
            opacity: 0.45;
            transform: scale(1.05);
            animation: slowZoom 20s ease-in-out infinite alternate;
        }

        @keyframes slowZoom {
            from { transform: scale(1.05); }
            to   { transform: scale(1.12); }
        }

        .panel-left .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                160deg,
                rgba(10,22,40,0.45) 0%,
                rgba(10,22,40,0.08) 30%,
                rgba(10,22,40,0.75) 65%,
                rgba(10,22,40,1) 100%
            );
        }

        /* Decorative circle accents */
        .panel-left .circle-1,
        .panel-left .circle-2 {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,0.15);
        }
        .panel-left .circle-1 {
            width: 460px; height: 460px;
            top: -100px; left: -120px;
        }
        .panel-left .circle-2 {
            width: 300px; height: 300px;
            top: 60px; left: 40px;
            border-color: rgba(201,168,76,0.08);
        }

        .panel-left-content {
            position: relative;
            z-index: 2;
            padding: 48px 52px;
        }

        .brand-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(201,168,76,0.12);
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 50px;
            padding: 6px 16px;
            margin-bottom: 28px;
        }
        .brand-tag span {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--gold-light);
        }
        .brand-tag i { color: var(--gold); font-size: 11px; }

        .panel-left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            line-height: 1.2;
            color: var(--white);
            margin-bottom: 16px;
        }
        .panel-left-content h1 em {
            font-style: normal;
            color: var(--gold-light);
        }

        .panel-left-content p {
            font-size: 14px;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 36px;
        }

        /* Stats row */
        .stats-row {
            display: flex;
            gap: 28px;
            margin-bottom: 40px;
        }
        .stat-item {
            display: flex;
            flex-direction: column;
        }
        .stat-item .num {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: var(--gold-light);
            font-weight: 700;
        }
        .stat-item .lbl {
            font-size: 11px;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Feature pills */
        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 7px 14px;
            font-size: 12px;
            color: rgba(255,255,255,0.75);
            backdrop-filter: blur(4px);
            transition: all .25s;
        }
        .pill i { color: var(--gold); font-size: 11px; }
        .pill:hover {
            background: rgba(201,168,76,0.12);
            border-color: rgba(201,168,76,0.35);
            color: var(--white);
        }

        /* Divider line */
        .left-divider {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), transparent);
            border-radius: 4px;
            margin-bottom: 32px;
        }

        /* ===== RIGHT PANEL ===== */
        .panel-right {
            width: 420px;
            min-width: 380px;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        /* Subtle right panel background */
        .panel-right::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
            top: -80px; right: -80px;
        }
        .panel-right::after {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(26,52,96,0.8) 0%, transparent 70%);
            bottom: -60px; left: -60px;
        }

        .form-container {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* Logo */
        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 36px;
        }
        .logo-wrap img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            border-radius: 16px;
            border: 2px solid rgba(201,168,76,0.3);
            padding: 6px;
            background: rgba(255,255,255,0.04);
            margin-bottom: 14px;
        }
        .logo-wrap .app-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--white);
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .logo-wrap .app-sub {
            font-size: 11px;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 3px;
        }

        /* Form heading */
        .form-heading {
            margin-bottom: 28px;
        }
        .form-heading h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 6px;
        }
        .form-heading p {
            font-size: 13px;
            color: var(--gray-400);
        }

        /* Input groups */
        .input-group {
            margin-bottom: 18px;
        }
        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap i.ico-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-dark);
            font-size: 14px;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 13px 44px;
            font-size: 14px;
            color: var(--white);
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .25s, background .25s, box-shadow .25s;
        }
        .input-wrap input::placeholder { color: rgba(255,255,255,0.25); }
        .input-wrap input:focus {
            border-color: var(--gold);
            background: rgba(201,168,76,0.05);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        .input-wrap input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 50px #112240 inset;
            -webkit-text-fill-color: #fff;
        }

        /* Toggle password */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
            cursor: pointer;
            font-size: 14px;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--gold); }

        /* Submit button */
        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px;
            margin-top: 28px;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 50%, var(--gold-light) 100%);
            background-size: 200% 200%;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-position .4s, transform .2s, box-shadow .3s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.25);
        }
        .btn-login:hover {
            background-position: right center;
            box-shadow: 0 6px 28px rgba(201,168,76,0.4);
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }

        /* Footer text */
        .form-footer {
            text-align: center;
            margin-top: 28px;
        }
        .form-footer p {
            font-size: 11px;
            color: rgba(255,255,255,0.25);
            line-height: 1.6;
        }
        .form-footer span { color: var(--gold); font-weight: 600; }

        /* Gold separator */
        .gold-line {
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border-radius: 2px;
            margin: 20px auto;
        }

        /* Alert error */
        .alert-error {
            display: none;
            align-items: center;
            gap: 10px;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 18px;
            font-size: 13px;
            color: #FCA5A5;
        }
        .alert-error i { color: var(--error); font-size: 14px; }

        /* Scrollbar for left panel if content overflows */
        @media (max-height: 680px) {
            .panel-left-content { padding: 30px 40px; }
            .stats-row { margin-bottom: 20px; }
            .feature-pills { display: none; }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .panel-left { display: none; }
            .panel-right {
                width: 100%;
                min-width: unset;
                background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            }
        }

        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,22,40,0.7);
            z-index: 999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }
        .spinner {
            width: 44px; height: 44px;
            border: 3px solid rgba(201,168,76,0.2);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Particle dots decoration on left panel */
        .dots {
            position: absolute;
            top: 0; right: 0;
            width: 220px; height: 220px;
            background-image: radial-gradient(circle, rgba(201,168,76,0.18) 1px, transparent 1px);
            background-size: 18px 18px;
            opacity: 0.5;
        }

        /* Entrance animation */
        .panel-right { animation: slideIn .5s cubic-bezier(0.16,1,0.3,1); }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .panel-left-content { animation: fadeUp .7s .1s cubic-bezier(0.16,1,0.3,1) both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<div class="login-wrapper">

    <!-- ===== LEFT PANEL ===== -->
    <div class="panel-left">
        <div class="bg-img"></div>
        <div class="overlay"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="dots"></div>

        <div class="panel-left-content">
            <div class="brand-tag">
                <i class="fa-solid fa-users-gear"></i>
                <span>Layanan Pengajuan Terpadu</span>
            </div>

            <div class="left-divider"></div>

            <h1>Kampus <em>Universitas</em><br>Ibnu Sina</h1>
            <p>
                Platform Layanan Terpadu Humas &amp; Publikasi
                <strong style="color:rgba(255,255,255,0.85)">Universitas Ibnu Sina</strong> —
                pusat pengajuan dukungan personil dokumentasi dan peminjaman peralatan publikasi secara profesional.
            </p>

            <div class="stats-row">
                <div class="stat-item">
                    <span class="num">500+</span>
                    <span class="lbl">Layanan Selesai</span>
                </div>
                <div class="stat-item">
                    <span class="num">12K+</span>
                    <span class="lbl">Total Dokumentasi</span>
                </div>
                <div class="stat-item">
                    <span class="num">50+</span>
                    <span class="lbl">Unit Terlayani</span>
                </div>
            </div>

            <div class="feature-pills">
                <span class="pill"><i class="fa-solid fa-users-gear"></i> Pengajuan Personil</span>
                <span class="pill"><i class="fa-solid fa-camera-retro"></i> Peminjaman Alat</span>
                <span class="pill"><i class="fa-solid fa-video"></i> Liputan &amp; Dokumentasi</span>
                <span class="pill"><i class="fa-solid fa-share-nodes"></i> Publikasi Media</span>
                <span class="pill"><i class="fa-solid fa-calendar-days"></i> Agenda Kegiatan</span>
            </div>
        </div>
    </div>

    <!-- ===== RIGHT PANEL ===== -->
    <div class="panel-right">
        <div class="form-container">

            <!-- Logo -->
            <div class="logo-wrap">
                <img src="https://assets.siakadcloud.com/uploads/uis/logoaplikasi/156.jpg" alt="Logo UIS">
                <div class="app-name">SIHUMAS</div>
                <div class="app-sub">Universitas Ibnu Sina</div>
            </div>

            <!-- Heading -->
            <div class="form-heading">
                <h2>Masuk ke Sistem</h2>
                <p>Masukkan kredensial Anda untuk melanjutkan.</p>
            </div>

            <!-- Alert Error -->
            <div class="alert-error" id="alertError">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="errorMsg">Email atau password tidak valid.</span>
            </div>

            <!-- Form -->
            <form action="{{ route('loginproses') }}" method="POST" id="loginForm">
                @csrf

                @if ($errors->any())
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var el = document.getElementById('alertError');
                            el.style.display = 'flex';
                            document.getElementById('errorMsg').textContent = '{{ $errors->first() }}';
                        });
                    </script>
                @endif

                <div class="input-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope ico-left"></i>
                        <input
                            type="email"
                            id="email"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="nama@uis.ac.id"
                            required
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock ico-left"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >
                        <i class="fa-solid fa-eye-slash toggle-pw" id="togglePw" onclick="togglePassword()"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Masuk ke Sistem
                </button>
            </form>

            <div class="gold-line"></div>

            <div class="form-footer">
                <p>Sistem Informasi Humas, Dokumentasi &amp; Publikasi<br>
                <span>Universitas Ibnu Sina</span> &copy; {{ date('Y') }}</p>
            </div>

        </div>
    </div>

</div>

<!-- Scripts -->
<script>
    // Toggle password visibility
    function togglePassword() {
        var pw = document.getElementById('password');
        var icon = document.getElementById('togglePw');
        if (pw.type === 'password') {
            pw.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            pw.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }

    // Show loading on submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });

    // Enter key support
    document.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            document.getElementById('loginForm').submit();
        }
    });
</script>

@include('vendor.sweetalert.alert')

</body>
</html>
