@extends('layouts.app')

@section('content')
    <div class="edit-page-wrapper">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Page Header -->
                    <div class="page-header mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="header-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="ms-3">
                                <h2 class="page-title mb-1">Edit Tugas</h2>
                                <p class="page-subtitle text-muted mb-0">Perbarui informasi tugas Anda</p>
                            </div>
                        </div>

                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb custom-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('task.index') }}">
                                        <i class="fas fa-home me-1"></i>Daftar Tugas
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Tugas</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger custom-alert" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content">
                                <h6 class="alert-title">Ups! Ada masalah dengan inputmu</h6>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Main Form Card -->
                    <div class="form-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Informasi Tugas
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('task.update', $task->id) }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <!-- Title Field -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-heading me-2"></i>Judul Tugas
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-tasks"></i>
                                        </span>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $task->title) }}" placeholder="Masukkan judul tugas..."
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Description Field -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-align-left me-2"></i>Deskripsi
                                    </label>
                                    <div class="textarea-wrapper">
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                            placeholder="Tambahkan deskripsi tugas (opsional)...">{{ old('description', $task->description) }}</textarea>
                                        <div class="textarea-counter">
                                            <span id="char-count">0</span>/500 karakter
                                        </div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Attachment Field -->
                                <div class="mb-3">
                                    <label for="attachment" class="form-label">
                                        <i class="fas fa-paperclip me-2"></i>Lampiran
                                    </label>
                                    <input type="file" name="attachment"
                                        class="form-control @error('attachment') is-invalid @enderror">
                                    @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Due Date Field -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-alt me-2"></i>Tenggat Waktu
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        <input type="date" name="due_date"
                                            class="form-control @error('due_date') is-invalid @enderror"
                                            value="{{ old('due_date', $task->due_date) }}" min="{{ date('Y-m-d') }}">
                                        @error('due_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($task->due_date)
                                        <small class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Tenggat saat ini: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                        </small>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="form-actions mt-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('task.index') }}" class="btn btn-light">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Kembali
                                        </a>
                                        <div class="d-flex gap-2">
                                            <button type="reset" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-2"></i>
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-2"></i>
                                                Update Tugas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="quick-actions-card mt-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-bolt me-2"></i>Aksi Cepat
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="{{ route('task.create') }}" class="quick-action-btn">
                                        <i class="fas fa-plus"></i>
                                        <span>Tugas Baru</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('task.index') }}" class="quick-action-btn">
                                        <i class="fas fa-list"></i>
                                        <span>Semua Tugas</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="quick-action-btn" onclick="duplicateTask()">
                                        <i class="fas fa-copy"></i>
                                        <span>Duplikat</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            --input-focus-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .edit-page-wrapper {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            position: relative;
        }

        .edit-page-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23667eea" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23764ba2" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--card-shadow);
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .page-subtitle {
            font-size: 1rem;
            color: #666;
        }

        .custom-breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .custom-breadcrumb .breadcrumb-item a {
            text-decoration: none;
            color: #667eea;
            font-weight: 500;
        }

        .custom-breadcrumb .breadcrumb-item.active {
            color: #666;
        }

        /* Alert Styling */
        .custom-alert {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 107, 107, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid #ff6b6b;
            display: flex;
            align-items: flex-start;
            box-shadow: var(--card-shadow);
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            background: var(--danger-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .alert-title {
            font-weight: 600;
            color: #721c24;
            margin-bottom: 0.5rem;
        }

        .alert-content ul {
            padding-left: 1rem;
            color: #721c24;
        }

        /* Form Card */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .form-card .card-header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem 2rem;
        }

        .form-card .card-body {
            padding: 2rem;
        }

        .card-title {
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.75rem;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: var(--input-focus-shadow);
            background: white;
        }

        .input-group-text {
            background: rgba(102, 126, 234, 0.1);
            border: 2px solid #e1e5e9;
            border-right: none;
            color: #667eea;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.15);
        }

        /* Textarea */
        .textarea-wrapper {
            position: relative;
        }

        .textarea-counter {
            position: absolute;
            bottom: 10px;
            right: 15px;
            font-size: 0.75rem;
            color: #666;
            background: rgba(255, 255, 255, 0.9);
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Status Toggle */
        .status-toggle {
            background: rgba(248, 249, 250, 0.8);
            border-radius: 12px;
            padding: 1rem;
            border: 2px solid #e1e5e9;
        }

        .form-switch .form-check-input {
            width: 3rem;
            height: 1.5rem;
            border-radius: 2rem;
            background-color: #dee2e6;
            border: none;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background: var(--success-gradient);
        }

        .switch-text .when-off,
        .switch-text .when-on {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-switch .form-check-input:not(:checked)~.form-check-label .when-on {
            display: none;
        }

        .form-switch .form-check-input:checked~.form-check-label .when-off {
            display: none;
        }

        .form-switch .form-check-input:checked~.form-check-label .when-on {
            color: #11998e;
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-success {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(17, 153, 142, 0.4);
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 2px solid #e1e5e9;
            color: #666;
        }

        .btn-light:hover {
            background: white;
            transform: translateY(-1px);
            box-shadow: var(--card-shadow);
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            transform: translateY(-1px);
        }

        /* Form Actions */
        .form-actions {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Quick Actions */
        .quick-actions-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
        }

        .quick-actions-card .card-body {
            padding: 1.5rem;
        }

        .quick-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 12px;
            text-decoration: none;
            color: #667eea;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            font-weight: 500;
        }

        .quick-action-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
            border-color: rgba(102, 126, 234, 0.2);
            color: #667eea;
        }

        .quick-action-btn i {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .quick-action-btn span {
            font-size: 0.85rem;
        }

        /* Form Text */
        .form-text {
            color: #666;
            font-size: 0.825rem;
            margin-top: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .header-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .form-card .card-body {
                padding: 1.5rem;
            }

            .form-actions .d-flex {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Character counter for textarea
            const textarea = document.querySelector('textarea[name="description"]');
            const counter = document.getElementById('char-count');

            if (textarea && counter) {
                function updateCounter() {
                    const count = textarea.value.length;
                    counter.textContent = count;

                    if (count > 400) {
                        counter.style.color = '#ee5a24';
                    } else if (count > 300) {
                        counter.style.color = '#f39c12';
                    } else {
                        counter.style.color = '#666';
                    }
                }

                updateCounter(); // Initial count
                textarea.addEventListener('input', updateCounter);
            }

            // Form validation enhancement
            const form = document.querySelector('.needs-validation');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });

            // Auto-resize textarea
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            }

            // Status toggle animation
            const statusToggle = document.getElementById('is_done');
            if (statusToggle) {
                statusToggle.addEventListener('change', function() {
                    const wrapper = this.closest('.status-toggle');
                    if (this.checked) {
                        wrapper.style.background = 'rgba(17, 153, 142, 0.1)';
                        wrapper.style.borderColor = 'rgba(17, 153, 142, 0.2)';
                    } else {
                        wrapper.style.background = 'rgba(248, 249, 250, 0.8)';
                        wrapper.style.borderColor = '#e1e5e9';
                    }
                });
            }

            // Button loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            if (submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                    submitBtn.setAttribute('disabled', 'disabled');
                });
            }
        });

        // Duplicate task function
        function duplicateTask() {
            const form = document.querySelector('form');
            const titleInput = form.querySelector('input[name="title"]');

            if (titleInput.value) {
                titleInput.value = titleInput.value + ' (Copy)';

                // Show notification
                const alert = document.createElement('div');
                alert.className = 'alert alert-info alert-dismissible fade show';
                alert.innerHTML = `
                <i class="fas fa-info-circle me-2"></i>
                Tugas siap diduplikat! Silakan sesuaikan informasi dan simpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

                form.parentNode.insertBefore(alert, form);

                setTimeout(() => {
                    alert.remove();
                }, 5000);
            }
        }
    </script>
@endpush
