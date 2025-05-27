@extends('layouts.app')

@section('content')
<style>
    .task-container {
        max-width: 600px;
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

    .task-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .task-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .task-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .task-header h2 {
        color: white;
        font-size: 2rem;
        font-weight: 600;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .task-icon {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 15px;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .task-body {
        padding: 40px;
    }

    .modern-alert {
        border-radius: 15px;
        border: none;
        margin-bottom: 30px;
        animation: shake 0.5s ease-in-out;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        box-shadow: 0 10px 25px rgba(238, 90, 82, 0.3);
        padding: 20px;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .modern-alert strong {
        display: block;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .modern-alert ul {
        list-style: none;
        margin: 0;
    }

    .modern-alert li {
        padding: 5px 0;
        position: relative;
        padding-left: 20px;
    }

    .modern-alert li::before {
        content: '•';
        position: absolute;
        left: 0;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 30px;
        position: relative;
    }

    .modern-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #4a5568;
        font-size: 0.95rem;
        position: relative;
        padding-left: 25px;
    }

    .modern-label.title-label::before {
        content: '📝';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .modern-label.desc-label::before {
        content: '📄';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .modern-label.date-label::before {
        content: '📅';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .modern-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
        position: relative;
    }

    .modern-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .modern-input:hover {
        border-color: #cbd5e0;
        background: white;
    }

    .modern-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .modern-btn {
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        flex: 1;
        min-width: 140px;
        justify-content: center;
    }

    .modern-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .modern-btn:hover::before {
        left: 100%;
    }

    .btn-modern-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-modern-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-modern-secondary {
        background: linear-gradient(135deg, #a8a8a8 0%, #8d8d8d 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(168, 168, 168, 0.3);
    }

    .btn-modern-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(168, 168, 168, 0.4);
        color: white;
        text-decoration: none;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .floating-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 40px;
        height: 40px;
        top: 80%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }

    @media (max-width: 768px) {
        .task-container {
            margin: 10px;
        }

        .task-body {
            padding: 30px 20px;
        }

        .button-group {
            flex-direction: column;
        }

        .modern-btn {
            flex: none;
        }

        .task-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="task-container">
    <div class="task-card">
        <div class="task-header">
            <div class="task-icon">
                ✨
            </div>
            <h2>Tambah Tugas Baru</h2>
        </div>

        <div class="task-body">
            @if ($errors->any())
                <div class="modern-alert">
                    <strong>⚠️ Ups!</strong> Ada masalah dengan inputmu.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('task.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="modern-label title-label">Judul Tugas</label>
                    <input type="text" name="title" class="modern-input" placeholder="Masukkan judul tugas..." value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label class="modern-label desc-label">Deskripsi</label>
                    <textarea name="description" class="modern-input modern-textarea" rows="4" placeholder="Deskripsi tugas (opsional)...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="modern-label date-label">Tenggat Waktu</label>
                    <input type="date" name="due_date" class="modern-input" value="{{ old('due_date') }}">
                </div>

                <div class="button-group">
                    <button type="submit" class="modern-btn btn-modern-primary">
                        💾 Simpan Tugas
                    </button>
                    <a href="{{ route('task.index') }}" class="modern-btn btn-modern-secondary">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add entrance animation to form elements
        const formElements = document.querySelectorAll('.form-group');
        formElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.animation = `slideUp 0.6s ease-out ${index * 0.1}s both`;
        });

        // Enhanced form interactions
        const inputs = document.querySelectorAll('.modern-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection