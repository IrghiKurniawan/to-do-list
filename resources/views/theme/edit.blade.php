@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header Section -->
                <div class="text-center mb-5">
                    <div class="header-icon mb-3">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h1 class="display-6 fw-bold text-primary mb-2">Edit Tema</h1>
                    <p class="text-muted">Ubah dan sesuaikan tema "<strong>{{ $theme->name }}</strong>" sesuai keinginan</p>
                </div>

                <!-- Main Form Card -->
                <div class="card theme-editor shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Original Theme Preview -->
                        <div class="original-theme-preview mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-history text-muted me-2"></i>
                                Tema Saat Ini
                            </h6>
                            <div class="current-theme-display">
                                <div class="theme-sample"
                                    style="background-color: {{ $theme->background_color }}; color: {{ $theme->text_color }};">
                                    <div class="sample-header">
                                        <div class="sample-dots">
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </div>
                                        <span class="sample-title">{{ $theme->name }}</span>
                                    </div>
                                    <div class="sample-content">
                                        <h6>Current Theme</h6>
                                        <p class="mb-0">This is how your theme currently looks</p>
                                    </div>
                                </div>
                                <div class="theme-info">
                                    <div class="color-chips">
                                        <div class="chip">
                                            <div class="chip-color"
                                                style="background-color: {{ $theme->background_color }};"></div>
                                            <span>{{ $theme->background_color }}</span>
                                        </div>
                                        <div class="chip">
                                            <div class="chip-color" style="background-color: {{ $theme->text_color }};">
                                            </div>
                                            <span>{{ $theme->text_color }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('theme.update', $theme->id) }}" method="POST" id="themeEditForm">
                            @csrf
                            @method('PUT')

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
                                        class="form-control border-start-0 ps-0" value="{{ $theme->name }}"
                                        placeholder="Masukkan nama tema" required>
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
                                            class="form-control form-control-color color-input"
                                            value="{{ $theme->background_color }}" required>
                                        <div class="color-info mt-2">
                                            <span class="color-hex"
                                                id="bg-hex">{{ strtoupper($theme->background_color) }}</span>
                                            <div class="color-name" id="bg-name">Background Color</div>
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
                                            class="form-control form-control-color color-input"
                                            value="{{ $theme->text_color }}" required>
                                        <div class="color-info mt-2">
                                            <span class="color-hex"
                                                id="text-hex">{{ strtoupper($theme->text_color) }}</span>
                                            <div class="color-name" id="text-name">Text Color</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('theme.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>
                                    Update Tema
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
            --success-gradient: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background: var(--success-gradient);
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

        .theme-editor {
            border-radius: 20px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .original-theme-preview {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px solid #dee2e6;
        }

        .current-theme-display {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .theme-sample {
            flex: 1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .sample-header {
            background: rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .sample-dots {
            display: flex;
            gap: 0.3rem;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.7;
        }

        .sample-title {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .sample-content {
            padding: 1rem;
        }

        .sample-content h6 {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .sample-content p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .theme-info {
            flex: 0 0 200px;
        }

        .color-chips {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .chip {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: white;
            padding: 0.6rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chip-color {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .chip span {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
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
        }

        .preview-section {
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 15px;
            padding: 2rem;
            border: 2px dashed #cbd5e0;
        }

        .preview-comparison {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .comparison-item {
            text-align: center;
        }

        .comparison-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 1rem;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .comparison-preview {
            display: flex;
            justify-content: center;
        }

        .preview-window {
            width: 100%;
            max-width: 280px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            background: #ffffff;
            color: #000000;
            transition: all 0.3s ease;
        }

        .preview-header {
            background: rgba(0, 0, 0, 0.05);
            padding: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .preview-dots {
            display: flex;
            gap: 0.3rem;
        }

        .preview-title {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .preview-content {
            padding: 1.2rem;
        }

        .preview-heading {
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .preview-text {
            margin-bottom: 1rem;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .preview-elements {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .preview-btn {
            background: currentColor;
            color: var(--preview-bg, #ffffff);
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .preview-card {
            background: rgba(0, 0, 0, 0.05);
            padding: 0.8rem;
            border-radius: 6px;
            flex: 1;
            min-width: 120px;
        }

        .preview-card strong {
            font-size: 0.8rem;
        }

        .preview-card p {
            font-size: 0.75rem;
            margin-top: 0.3rem;
        }

        .color-adjustments {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
        }

        .adjustment-controls {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .control-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #4a5568;
        }

        .control-buttons {
            display: flex;
            gap: 0.5rem;
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

        .btn-success {
            background: var(--success-gradient);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
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

            .current-theme-display {
                flex-direction: column;
            }

            .theme-info {
                flex: none;
                width: 100%;
            }

            .color-chips {
                flex-direction: row;
                justify-content: center;
            }

            .preview-comparison {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .adjustment-controls {
                flex-direction: column;
                gap: 1rem;
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
