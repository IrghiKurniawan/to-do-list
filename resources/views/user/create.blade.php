@extends('layouts.app')

@section('content')
<style>
    .account-container {
        max-width: 700px;
        margin: 0 auto;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .account-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0;
    }

    .account-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .account-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .account-header h2 {
        color: white;
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .account-icon {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    .account-body {
        padding: 50px;
    }

    .modern-alert {
        border-radius: 16px;
        border: none;
        margin-bottom: 30px;
        padding: 20px 25px;
        position: relative;
        overflow: hidden;
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
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-8px); }
        40% { transform: translateX(8px); }
        60% { transform: translateX(-4px); }
        80% { transform: translateX(4px); }
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
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .modern-alert ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .modern-alert li {
        padding: 8px 0;
        position: relative;
        padding-left: 25px;
        font-weight: 500;
    }

    .modern-alert li::before {
        content: '⚠️';
        position: absolute;
        left: 0;
        top: 8px;
    }

    .alert-success li::before {
        content: '✅';
    }

    .form-row {
        margin-bottom: 35px;
        position: relative;
    }

    .modern-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 1rem;
        margin-bottom: 12px;
        display: block;
        position: relative;
        padding-left: 30px;
        transition: color 0.3s ease;
    }

    .modern-label.name-label::before {
        content: '👤';
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2rem;
    }

    .modern-label.email-label::before {
        content: '📧';
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2rem;
    }

    .modern-label.role-label::before {
        content: '🏷️';
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2rem;
    }

    .modern-label.password-label::before {
        content: '🔒';
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.2rem;
    }

    .form-input-wrapper {
        position: relative;
    }

    .modern-input, .modern-select {
        width: 100%;
        padding: 18px 25px;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 1.1rem;
        transition: all 0.4s ease;
        background: #f8fafc;
        position: relative;
        font-family: inherit;
    }

    .modern-input:focus, .modern-select:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-3px);
    }

    .modern-input:hover, .modern-select:hover {
        border-color: #cbd5e0;
        background: white;
        transform: translateY(-1px);
    }

    .modern-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 50px;
    }

    .modern-select:focus {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    }

    .input-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 1.2rem;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .modern-input:focus + .input-icon {
        color: #667eea;
    }

    .submit-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 16px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        margin-top: 20px;
        min-width: 160px;
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
    }

    .submit-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .submit-button:hover::before {
        left: 100%;
    }

    .submit-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
    }

    .submit-button:active {
        transform: translateY(-2px);
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        animation: float 8s ease-in-out infinite;
    }

    .floating-shape:nth-child(1) {
        width: 120px;
        height: 120px;
        top: 15%;
        left: 8%;
        animation-delay: 0s;
    }

    .floating-shape:nth-child(2) {
        width: 80px;
        height: 80px;
        top: 50%;
        right: 10%;
        animation-delay: 3s;
    }

    .floating-shape:nth-child(3) {
        width: 60px;
        height: 60px;
        top: 75%;
        left: 15%;
        animation-delay: 6s;
    }

    .floating-shape:nth-child(4) {
        width: 40px;
        height: 40px;
        top: 25%;
        right: 25%;
        animation-delay: 1.5s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.7;
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .account-container {
            margin: 10px;
        }

        .account-body {
            padding: 30px 25px;
        }

        .account-header {
            padding: 30px;
        }

        .account-header h2 {
            font-size: 1.8rem;
        }

        .modern-input, .modern-select {
            padding: 16px 20px;
            font-size: 1rem;
        }

        .submit-button {
            width: 100%;
            padding: 16px;
        }
    }

    /* Additional animations for form elements */
    .form-row {
        animation: slideInUp 0.6s ease-out both;
    }

    .form-row:nth-child(1) { animation-delay: 0.1s; }
    .form-row:nth-child(2) { animation-delay: 0.2s; }
    .form-row:nth-child(3) { animation-delay: 0.3s; }
    .form-row:nth-child(4) { animation-delay: 0.4s; }
    .form-row:nth-child(5) { animation-delay: 0.5s; }

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
</style>

<div class="floating-elements">
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
</div>

<div class="account-container">
    <div class="account-card">
        <div class="account-header">
            <div class="account-icon">
                👥
            </div>
            <h2>Kelola Akun Pengguna</h2>
        </div>

        <div class="account-body">
            @if ($errors->any())
                <div class="modern-alert alert-danger">
                    <strong>🚨 Terjadi Kesalahan!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::get('success'))
                <div class="modern-alert alert-success">
                    <strong>🎉 Berhasil!</strong>
                    <ul>
                        <li>{{ Session::get('success') }}</li>
                    </ul>
                </div>
            @endif

            <form action="{{ route('kelola_akun.tambah.proses') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <label for="name" class="modern-label name-label">Nama Lengkap</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="modern-input" id="name" name="name" 
                               value="{{ old('name') }}" placeholder="Masukkan nama lengkap...">
                        <div class="input-icon">👤</div>
                    </div>
                </div>

                <div class="form-row">
                    <label for="email" class="modern-label email-label">Alamat Email</label>
                    <div class="form-input-wrapper">
                        <input type="email" class="modern-input" id="email" name="email" 
                               value="{{ old('email') }}" placeholder="contoh@email.com">
                        <div class="input-icon">📧</div>
                    </div>
                </div>

                <div class="form-row">
                    <label for="role" class="modern-label role-label">Tipe Pengguna</label>
                    <div class="form-input-wrapper">
                        <select class="modern-select" name="role" id="role">
                            <option selected disabled hidden>Pilih tipe pengguna...</option>
                            <option value="admin" {{ old('role') == "admin" ? 'selected' : '' }}>👑 Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <label for="password" class="modern-label password-label">Password</label>
                    <div class="form-input-wrapper">
                        <input type="password" class="modern-input" id="password" name="password" 
                               placeholder="Masukkan password yang kuat...">
                        <div class="input-icon">🔒</div>
                    </div>
                </div>

                <button type="submit" class="submit-button">
                    💾 Simpan Pengguna Baru
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced form interactions
        const inputs = document.querySelectorAll('.modern-input, .modern-select');
        
        inputs.forEach(input => {
            // Focus effects
            input.addEventListener('focus', function() {
                const label = this.closest('.form-row').querySelector('.modern-label');
                if (label) {
                    label.style.color = '#667eea';
                    label.style.transform = 'translateX(5px)';
                }
            });
            
            // Blur effects
            input.addEventListener('blur', function() {
                const label = this.closest('.form-row').querySelector('.modern-label');
                if (label) {
                    label.style.color = '#4a5568';
                    label.style.transform = 'translateX(0)';
                }
            });
        });

        // Form submission enhancement
        const form = document.querySelector('form');
        const submitButton = document.querySelector('.submit-button');
        
        form.addEventListener('submit', function(e) {
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '⏳ Menyimpan...';
            submitButton.disabled = true;
            submitButton.style.background = 'linear-gradient(135deg, #a0aec0 0%, #718096 100%)';
            
            // Reset after a delay if form doesn't actually submit
            setTimeout(() => {
                if (submitButton.disabled) {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    submitButton.style.background = '';
                }
            }, 3000);
        });

        // Password strength indicator (visual enhancement)
        const passwordInput = document.getElementById('password');
        passwordInput.addEventListener('input', function() {
            const strength = this.value.length;
            const icon = this.nextElementSibling;
            
            if (strength < 6) {
                icon.innerHTML = '🔓';
                icon.style.color = '#ff6b6b';
            } else if (strength < 10) {
                icon.innerHTML = '🔒';
                icon.style.color = '#ffa500';
            } else {
                icon.innerHTML = '🔐';
                icon.style.color = '#51cf66';
            }
        });
    });
</script>
@endsection 