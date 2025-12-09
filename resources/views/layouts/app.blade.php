<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do List</title>
    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- asset : memanggil file yg ada di folder public biasanya untuk css,js atau gambar/file tambahan --}}
    <link rel="stylesheet" href="style.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%) !important;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: #f8f9ff !important;
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.7rem 1.2rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Mobile responsive */
        @media (max-width: 991.98px) {
            .navbar-nav {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                padding: 1rem;
                margin-top: 1rem;
                backdrop-filter: blur(10px);
            }

            .navbar-nav .nav-link {
                margin: 0.2rem 0;
                text-align: center;
            }
        }

        /* Animation for brand */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .navbar-brand:hover {
            animation: pulse 1s ease-in-out;
        }

        /* Glass morphism effect */
        .navbar {
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    @stack('style')
</head>

<body>
    @if (Auth::check())
        <nav class="navbar navbar-expand-lg navbar-light bg-primary" style="position: sticky; top: 0; z-index: 100;">
            <div class="container">
                <a class="navbar-brand" href="#">To Do List</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }}"
                                href="{{ route('landing_page') }}">Home</a>
                        </li>
                        @if (Auth::user()->role == 'admin')           
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('kelola_akun.data') ? 'active' : '' }}"
                                href="{{ route('kelola_akun.data') }}">Kelola Akun</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('task.index') ? 'active' : '' }}"
                                href="{{ route('task.index') }}">Daftar Tugas</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::is('theme.index') ? 'active' : '' }}"
                                href="{{ route('theme.index') }}">Theme</a>
                        </li> --}}
                    </ul>
                    <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            
            <!-- Avatar icon -->
            <i class="bi bi-person-circle fs-4 me-2"></i>
            <span class="fw-medium">{{ auth()->user()->name }}</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2"
            aria-labelledby="navbarDropdown">
            
            <!-- User info -->
            <li class="px-3 mb-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-badge fs-5 me-2 text-primary"></i>
                    <div>
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                    </div>
                </div>
            </li>

            <li><hr class="dropdown-divider"></li>

            <!-- Logout -->
            <li>
                <a href="{{ route('logout') }}" class="dropdown-item text-danger d-flex align-items-center">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </li>
</ul>


                </div>
            </div>
        </nav>
    @endif

    {{-- yield : mengisi bagian content dinamis/bagian yg akan berubah-ubah di tiap halamannya --}}
    <main class="py-4">
        @yield('content')
    </main>

    @if (Auth::check())
        <footer class="bg-primary text-center py-3 border-top">
            <div class="container">
                <span class="text-muted">&copy; {{ date('Y') }} Irghi's To-Do App.</span>
            </div>
        </footer>
    @endif

    {{-- CDN Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>

    {{-- stack : tidak wajib diisi oleh view yg extends nya (optional), kalau yield wajib diisi oleh view extends nya
    --}}
    @stack('script')
</body>

</html>