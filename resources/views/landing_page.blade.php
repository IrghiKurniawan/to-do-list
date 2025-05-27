@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $tasksCount = App\Models\Task::count();
        $doneCount = App\Models\Task::where('is_done', true)->count();
        $pendingCount = App\Models\Task::where('is_done', false)->count();

    @endphp
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="badge bg-primary mb-3 px-3 py-2">
                            <i class="fas fa-rocket me-1"></i>
                            Productivity App
                        </div>
                        <h1 class="hero-title mb-4">
                            Selamat Datang di
                            <span class="text-gradient">To-Do List Irghi</span>
                        </h1>
                        <p class="hero-subtitle mb-4 text-muted">
                            Kelola tugasmu dengan mudah dan teratur. Tingkatkan produktivitas dengan sistem manajemen tugas
                            yang powerful dan user-friendly.
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="{{ route('task.index') }}" class="btn btn-primary btn-lg px-4 py-3">
                                <i class="fas fa-list-check me-2"></i>
                                Lihat Daftar Tugas
                            </a>
                            <a href="{{ route('task.create') }}" class="btn btn-outline-primary btn-lg px-4 py-3">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Tugas Baru
                            </a>
                        </div>

                        <!-- Quick Stats -->
                        <div class="row g-3 mt-4">
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-primary">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="stat-number">{{ $tasksCount }}</div>
                                    <div class="stat-label">Total Tugas</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="stat-number">{{ $doneCount }}</div>
                                    <div class="stat-label">Selesai</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-number">{{$pendingCount}}</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <!-- Task Cards Animation -->
                        <div class="floating-cards">
                            <div class="task-card card-1">
                                <div class="d-flex align-items-center">
                                    <div class="task-checkbox checked"></div>
                                    <span class="task-text completed">Meeting dengan tim</span>
                                </div>
                            </div>
                            <div class="task-card card-2">
                                <div class="d-flex align-items-center">
                                    <div class="task-checkbox"></div>
                                    <span class="task-text">Review dokumentasi</span>
                                </div>
                            </div>
                            <div class="task-card card-3">
                                <div class="d-flex align-items-center">
                                    <div class="task-checkbox checked"></div>
                                    <span class="task-text completed">Update progress report</span>
                                </div>
                            </div>
                            <div class="task-card card-4">
                                <div class="d-flex align-items-center">
                                    <div class="task-checkbox"></div>
                                    <span class="task-text">Persiapan presentasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    {{-- <section class="features-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Mengapa Pilih To-Do List Irghi?</h2>
                    <p class="section-subtitle text-muted">Fitur-fitur powerful untuk meningkatkan produktivitas Anda</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon bg-primary">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Cepat & Mudah</h4>
                        <p class="text-muted">Interface yang intuitif memungkinkan Anda menambah dan mengelola tugas dengan
                            cepat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon bg-success">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Responsive Design</h4>
                        <p class="text-muted">Akses tugas Anda dari perangkat apapun - desktop, tablet, atau smartphone.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon bg-warning">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Track Progress</h4>
                        <p class="text-muted">Pantau kemajuan tugas Anda dengan statistik yang jelas dan mudah dipahami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('style')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23667eea" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23764ba2" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23667eea" opacity="0.15"/><circle cx="90" cy="40" r="0.5" fill="%23764ba2" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .btn-lg {
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            box-shadow: var(--card-shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        .btn-outline-primary {
            border: 2px solid #667eea;
            color: #667eea;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .btn-outline-primary:hover {
            background: var(--primary-gradient);
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        /* Quick Stats */
        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            color: white;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        /* Floating Task Cards */
        .hero-illustration {
            position: relative;
            height: 500px;
        }

        .floating-cards {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .task-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: float 6s ease-in-out infinite;
        }

        .task-card:hover {
            transform: scale(1.05);
            box-shadow: var(--hover-shadow);
        }

        .card-1 {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .card-2 {
            top: 30%;
            right: 20%;
            animation-delay: 1.5s;
        }

        .card-3 {
            bottom: 40%;
            left: 5%;
            animation-delay: 3s;
        }

        .card-4 {
            bottom: 10%;
            right: 10%;
            animation-delay: 4.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #ddd;
            margin-right: 0.75rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .task-checkbox.checked {
            background: var(--success-gradient);
            border-color: #11998e;
        }

        .task-checkbox.checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .task-text {
            font-weight: 500;
            color: #333;
        }

        .task-text.completed {
            text-decoration: line-through;
            color: #888;
        }

        /* Features Section */
        .features-section {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .section-subtitle {
            font-size: 1.1rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.5rem;
        }

        .feature-card h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .floating-cards {
                display: none;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats on scroll
            const observerOptions = {
                threshold: 0.5
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stat-card, .feature-card').forEach(card => {
                observer.observe(card);
            });

            // Add click animation to buttons
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    let ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
@endpush
