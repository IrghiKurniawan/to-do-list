@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-gradient rounded-circle mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-user-edit text-white fs-2"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Edit Akun Pengguna</h2>
                <p class="text-muted">Perbarui informasi akun pengguna dengan mudah</p>
            </div>

            <!-- Main Form Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Card Header with Gradient -->
                <div class="card-header bg-gradient text-white py-4" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-edit me-2"></i>
                        Form Edit Pengguna
                    </h4>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5">
                    <!-- Success Alert -->
                    @if(Session::get('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, #d4edda, #c3e6cb);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, #f8d7da, #f1aeb5);">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle me-3 fs-5 mt-1"></i>
                                <div>
                                    <strong>Terjadi Kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('kelola_akun.ubah.proses', $user['id'])}}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nama Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>
                                Nama Lengkap
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 rounded-end-3 py-3" 
                                       id="name" 
                                       name="name" 
                                       value="{{ $user['name'] }}"
                                       placeholder="Masukkan nama lengkap"
                                       style="background: #f8f9fa;">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                Alamat Email
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" 
                                       class="form-control border-start-0 rounded-end-3 py-3" 
                                       id="email" 
                                       name="email" 
                                       value="{{ $user['email'] }}"
                                       placeholder="contoh@email.com"
                                       style="background: #f8f9fa;">
                            </div>
                        </div>

                        <!-- Role Field -->
                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-users-cog me-2 text-primary"></i>
                                Tipe Pengguna
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="fas fa-user-tag text-muted"></i>
                                </span>
                                <select class="form-select border-start-0 rounded-end-3 py-3" 
                                        name="role" 
                                        id="role"
                                        style="background: #f8f9fa;">
                                    <option selected disabled hidden>Pilih Tipe Pengguna</option>
                                    <option value="admin" {{ $user['role'] == "admin" ? 'selected' : '' }}>
                                        👨‍💼 Admin
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-5">
                            <label for="password" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-lock me-2 text-primary"></i>
                                Password Baru
                                <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" 
                                       class="form-control border-start-0 rounded-end-3 py-3" 
                                       id="password" 
                                       name="password" 
                                       value="{{ old('password') }}"
                                       placeholder="Masukkan password baru"
                                       style="background: #f8f9fa;">
                                <button class="btn btn-outline-secondary border-start-0" 
                                        type="button" 
                                        onclick="togglePassword()"
                                        style="border-color: #ced4da;">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 py-3 fw-semibold" 
                                        style="background: linear-gradient(135deg, #667eea, #764ba2); border: none;">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('kelola_akun.data') }}" 
                                   class="btn btn-outline-secondary btn-lg w-100 rounded-3 py-3 fw-semibold">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .input-group-text {
        border-color: #ced4da;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .alert {
        animation: slideInDown 0.5s ease-out;
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<!-- JavaScript for Password Toggle -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection