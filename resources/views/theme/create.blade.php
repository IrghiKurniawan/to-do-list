@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header Section -->
                <div class="text-center mb-5">
                    <div class="header-icon mb-3">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-primary mb-2">Buat Tema Baru</h1>
                    <p class="text-muted">Kustomisasi tampilan aplikasi sesuai keinginan Anda</p>
                </div>

                <!-- Main Form Card -->
                <div class="card theme-creator shadow-lg border-0">
                    <div class="card-body p-5">
                        <form action="{{ route('theme.store') }}" method="POST" id="themeForm">
                            @csrf

                            <!-- Theme Name Input -->
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-semibold mb-3">
                                    <i class="fas fa-tag text-primary me-2"></i>
                                    Nama Tema
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-font text-muted"></i>
                                    </span>
                                    <input type="text" name="name" id="name"
                                        class="form-control border-start-0 ps-0"
                                        placeholder="Masukkan nama tema (contoh: Dark Ocean, Sunset Glow)" required>
                                </div>
                            </div>

                            <!-- Color Selection Section -->
                            <div class="row g-4 mb-5">
                                <!-- Background Color -->
                                <div class="col-md-6">
                                    <label for="background_color" class="form-label fw-semibold mb-3">
                                        <i class="fas fa-fill-drip text-primary me-2"></i>
                                        Warna Latar Belakang
                                    </label>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="background_color" id="background_color"
                                            class="form-control form-control-color color-input" value="#ffffff" required>
                                        <div class="color-info mt-2">
                                            <span class="color-hex" id="bg-hex">#ffffff</span>
                                            <div class="color-name" id="bg-name">White</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Color -->
                                <div class="col-md-6">
                                    <label for="text_color" class="form-label fw-semibold mb-3">
                                        <i class="fas fa-font text-primary me-2"></i>
                                        Warna Teks
                                    </label>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="text_color" id="text_color"
                                            class="form-control form-control-color color-input" value="#000000" required>
                                        <div class="color-info mt-2">
                                            <span class="color-hex" id="text-hex">#000000</span>
                                            <div class="color-name" id="text-name">Black</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('theme.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Tema
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: var(--shadow-soft);
        }

        .header-icon i {
            font-size: 2rem;
            color: white;
        }

        .theme-creator {
            border-radius: 20px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .theme-creator:hover {
            box-shadow: var(--shadow-hover);
        }

        .form-label {
            color: #2d3748;
            font-size: 1.1rem;
        }

        .input-group-text {
            border-color: #e2e8f0;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
        }

        .form-control {
            border-color: #e2e8f0;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }

        .color-picker-wrapper {
            position: relative;
        }

        .color-input {
            width: 100%;
            height: 80px;
            border-radius: 15px;
            border: 3px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .color-input:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-soft);
        }

        .color-info {
            text-align: center;
            padding: 0.5rem;
        }

        .color-hex {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 1.1rem;
            color: #4a5568;
        }

        .color-name {
            font-size: 0.9rem;
            color: #718096;
            text-transform: capitalize;
        }

        .preview-section {
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 15px;
            padding: 2rem;
            border: 2px dashed #cbd5e0;
        }

        .theme-preview-container {
            display: flex;
            justify-content: center;
        }

        .live-preview {
            width: 100%;
            max-width: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            background: #ffffff;
            color: #000000;
            transition: all 0.3s ease;
        }

        .preview-header {
            background: rgba(0, 0, 0, 0.05);
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .preview-dots {
            display: flex;
            gap: 0.5rem;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.6;
        }

        .preview-title {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .preview-content {
            padding: 2rem;
        }

        .preview-heading {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .preview-text {
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .preview-elements {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .preview-btn {
            background: currentColor;
            color: var(--preview-bg, #ffffff);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            opacity: 0.9;
        }

        .preview-card {
            background: rgba(0, 0, 0, 0.05);
            padding: 1rem;
            border-radius: 8px;
            flex: 1;
            min-width: 200px;
        }

        .preset-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        .preset-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            border-radius: 12px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .preset-item:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: var(--shadow-soft);
        }

        .preset-colors {
            display: flex;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .preset-bg,
        .preset-text {
            width: 25px;
            height: 25px;
        }

        .preset-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #4a5568;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .btn-outline-secondary {
            border-color: #cbd5e0;
            color: #4a5568;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #f7fafc;
            border-color: #a0aec0;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .card-body {
                padding: 2rem 1.5rem;
            }

            .d-flex.gap-3 {
                flex-direction: column;
            }

            .btn-lg {
                width: 100%;
            }

            .preset-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
@endsection
