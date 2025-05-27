@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Buat Akun Baru</h2>
            <p>Bergabunglah dengan kami untuk pengalaman yang lebih baik</p>
        </div>
        
        <form action="{{ route('register.proses') }}" method="POST" class="register-form">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <circle cx="12" cy="16" r="1"></circle>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <circle cx="12" cy="16" r="1"></circle>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="register-btn">
                <span>Daftar Sekarang</span>
                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </form>
        
        <div class="register-footer">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.register-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.register-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
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

.register-header {
    text-align: center;
    margin-bottom: 30px;
}

.register-header h2 {
    color: #2d3748;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 8px;
}

.register-header p {
    color: #718096;
    font-size: 16px;
}

.register-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    color: #2d3748;
    font-weight: 600;
    font-size: 14px;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 12px;
    width: 20px;
    height: 20px;
    color: #a0aec0;
    z-index: 1;
}

.input-wrapper input {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 16px;
    background: #ffffff;
    transition: all 0.3s ease;
    outline: none;
}

.input-wrapper input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.input-wrapper input:focus + .input-icon,
.input-wrapper input:not(:placeholder-shown) + .input-icon {
    color: #667eea;
}

.input-wrapper input::placeholder {
    color: #a0aec0;
}

.error-message {
    color: #e53e3e;
    font-size: 13px;
    margin-top: 4px;
}

.register-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 16px 24px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
}

.register-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.register-btn:active {
    transform: translateY(0);
}

.btn-icon {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

.register-btn:hover .btn-icon {
    transform: translateX(3px);
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

/* Responsive Design */
@media (max-width: 480px) {
    .register-container {
        padding: 15px;
    }
    
    .register-card {
        padding: 30px 25px;
    }
    
    .register-header h2 {
        font-size: 24px;
    }
    
    .input-wrapper input {
        padding: 12px 12px 12px 40px;
        font-size: 14px;
    }
    
    .register-btn {
        padding: 14px 20px;
        font-size: 14px;
    }
}

/* Loading Animation for Button */
.register-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    margin: auto;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.register-btn.loading span,
.register-btn.loading .btn-icon {
    opacity: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.register-form');
    const submitBtn = document.querySelector('.register-btn');
    
    // Add loading state on form submit
    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });
    
    // Add real-time validation feedback
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#48bb78';
            }
        });
        
        input.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(72, 187, 120)') {
                this.style.borderColor = '#e2e8f0';
            }
        });
    });
    
    // Password confirmation validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    
    function validatePasswords() {
        if (confirmPassword.value !== '' && password.value !== confirmPassword.value) {
            confirmPassword.style.borderColor = '#e53e3e';
        } else if (confirmPassword.value !== '' && password.value === confirmPassword.value) {
            confirmPassword.style.borderColor = '#48bb78';
        }
    }
    
    password.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);
});
</script>
@endsection