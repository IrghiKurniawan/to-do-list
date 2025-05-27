@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.8s ease-out;
            position: relative;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: rotate(0deg) translate(0, 0);
            }

            33% {
                transform: rotate(120deg) translate(10px, -10px);
            }

            66% {
                transform: rotate(240deg) translate(-10px, 10px);
            }
        }

        .login-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            animation: bounce 3s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) scale(1);
            }

            40% {
                transform: translateY(-10px) scale(1.05);
            }

            60% {
                transform: translateY(-5px) scale(1.02);
            }
        }

        .login-title {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 2;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }

        .login-body {
            padding: 40px 30px;
        }

        .modern-alert {
            border-radius: 16px;
            border: none;
            margin-bottom: 25px;
            padding: 18px 22px;
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 12px 30px rgba(238, 90, 82, 0.3);
            animation: shake 0.6s ease-in-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #51cf66, #40c057);
            color: white;
            box-shadow: 0 12px 30px rgba(64, 192, 87, 0.3);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modern-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .modern-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #4a5568;
            font-size: 1rem;
            position: relative;
            padding-left: 30px;
            transition: all 0.3s ease;
        }

        .modern-label.email-label::before {
            content: '📧';
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .modern-label.password-label::before {
            content: '🔒';
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .input-wrapper {
            position: relative;
        }

        .modern-input {
            width: 100%;
            padding: 18px 25px 18px 55px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 1.1rem;
            transition: all 0.4s ease;
            background: #f8fafc;
            font-family: inherit;
        }

        .modern-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .modern-input:hover {
            border-color: #cbd5e0;
            background: white;
            transform: translateY(-1px);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.3rem;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .modern-input:focus+.input-icon {
            transform: translateY(-50%) scale(1.1);
            filter: brightness(1.2);
        }

        .error-message {
            color: #e53e3e;
            font-size: 0.9rem;
            margin-top: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message::before {
            content: '⚠️';
            font-size: 0.9rem;
        }

        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(-1px);
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShape 10s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 70%;
            right: 10%;
            animation-delay: 3s;
        }

        .floating-shape:nth-child(3) {
            width: 80px;
            height: 80px;
            top: 40%;
            right: 20%;
            animation-delay: 6s;
        }

        .floating-shape:nth-child(4) {
            width: 40px;
            height: 40px;
            top: 20%;
            left: 80%;
            animation-delay: 1.5s;
        }

        .floating-shape:nth-child(5) {
            width: 120px;
            height: 120px;
            top: 80%;
            left: 15%;
            animation-delay: 4.5s;
        }

        @keyframes floatShape {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-40px) rotate(180deg);
                opacity: 1;
            }
        }

        .register-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .register-footer p {
            color: #718096;
            font-size: 14px;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .login-container {
                padding: 15px;
            }

            .login-card {
                max-width: 100%;
            }

            .login-body {
                padding: 30px 25px;
            }

            .login-header {
                padding: 30px 25px;
            }

            .login-title {
                font-size: 1.7rem;
            }

            .modern-input {
                padding: 16px 20px 16px 50px;
                font-size: 1rem;
            }

            .login-button {
                padding: 16px;
                font-size: 1rem;
            }
        }

        /* Form animation stagger */
        .form-group:nth-child(1) {
            animation: slideInUp 0.6s ease-out 0.2s both;
        }

        .form-group:nth-child(2) {
            animation: slideInUp 0.6s ease-out 0.3s both;
        }

        .form-group:nth-child(3) {
            animation: slideInUp 0.6s ease-out 0.4s both;
        }

        .login-button {
            animation: slideInUp 0.6s ease-out 0.5s both;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus states for better accessibility */
        .modern-input:focus+.input-icon+.modern-label::before {
            transform: scale(1.2);
        }
    </style>

    <div class="floating-elements">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                {{-- <div class="login-icon">
                🔐
            </div> --}}
                <h4 class="login-title">Selamat Datang</h4>
            </div>

            <div class="login-body">
                @if (Session::get('failed'))
                    <div class="modern-alert alert-danger">
                        🚫 {{ Session::get('failed') }}
                    </div>
                @endif

                @if (Session::get('logout'))
                    <div class="modern-alert alert-success">
                        ✅ {{ Session::get('logout') }}
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="modern-label email-label">Alamat Email</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" id="email" class="modern-input"
                                placeholder="Masukkan email Anda..." required>
                            <div class="input-icon">📧</div>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="modern-label password-label">Kata Sandi</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="password" class="modern-input"
                                placeholder="Masukkan password Anda..." required>
                            <div class="input-icon">🔒</div>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="login-button">
                        🚀 Masuk Sekarang
                    </button>
                </form>
                <div class="register-footer">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Register di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced form interactions
            const inputs = document.querySelectorAll('.modern-input');

            inputs.forEach(input => {
                // Dynamic placeholder effects
                input.addEventListener('focus', function() {
                    const label = this.closest('.form-group').querySelector('.modern-label');
                    const icon = this.nextElementSibling;

                    if (label) {
                        label.style.color = '#667eea';
                        label.style.transform = 'translateX(5px)';
                    }
                });

                input.addEventListener('blur', function() {
                    const label = this.closest('.form-group').querySelector('.modern-label');

                    if (label) {
                        label.style.color = '#4a5568';
                        label.style.transform = 'translateX(0)';
                    }
                });

                // Typing animation effect
                input.addEventListener('input', function() {
                    const icon = this.nextElementSibling;
                    icon.style.transform = 'translateY(-50%) scale(1.1)';

                    setTimeout(() => {
                        icon.style.transform = 'translateY(-50%) scale(1)';
                    }, 150);
                });
            });

            // Form submission enhancement
            const form = document.querySelector('form');
            const submitButton = document.querySelector('.login-button');

            form.addEventListener('submit', function(e) {
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '⏳ Memproses...';
                submitButton.disabled = true;
                submitButton.style.background = 'linear-gradient(135deg, #a0aec0 0%, #718096 100%)';

                // Reset after delay if form doesn't submit
                setTimeout(() => {
                    if (submitButton.disabled) {
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                        submitButton.style.background = '';
                    }
                }, 3000);
            });

            // Password visibility toggle (optional enhancement)
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordInput.nextElementSibling;

            let showPassword = false;
            passwordIcon.addEventListener('click', function() {
                showPassword = !showPassword;
                passwordInput.type = showPassword ? 'text' : 'password';
                this.innerHTML = showPassword ? '👁️' : '🔒';
            });

            passwordIcon.style.cursor = 'pointer';
            passwordIcon.title = 'Klik untuk show/hide password';

            // Add subtle parallax effect to floating shapes
            document.addEventListener('mousemove', function(e) {
                const shapes = document.querySelectorAll('.floating-shape');
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;

                shapes.forEach((shape, index) => {
                    const speed = (index + 1) * 0.5;
                    const xMove = (mouseX - 0.5) * speed * 20;
                    const yMove = (mouseY - 0.5) * speed * 20;

                    shape.style.transform = `translate(${xMove}px, ${yMove}px)`;
                });
            });
        });
    </script>
@endsection
