@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-2">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-1 text-gray-800 fw-bold">
                            <i class="fas fa-palette text-primary me-2"></i>
                            Daftar Tema
                        </h1>
                        <p class="text-muted mb-0">Kelola tema aplikasi Anda dengan mudah</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <form action="{{ route('theme.index') }}" method="GET" class="d-flex">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" placeholder="Cari Theme..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('theme.create') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Tema Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Themes Grid -->
        <div class="row g-4">
            @foreach ($theme as $themes)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card theme-card shadow-sm border-0 h-100">
                        <!-- Theme Preview Header -->
                        <div class="card-header border-0 p-0">
                            <div class="theme-preview"
                                style="background: linear-gradient(135deg, {{ $themes->background_color }}, {{ $themes->background_color }}dd);">
                                <div class="preview-content" style="color: {{ $themes->text_color }};">
                                    <div class="preview-window">
                                        <div class="preview-dots">
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </div>
                                        <div class="preview-text">
                                            <h6 class="mb-1">Sample Text</h6>
                                            <p class="mb-0 small">Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Theme Details -->
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0 fw-bold">{{ $themes->name }}</h5>
                                @if ($themes->is_dark_mode)
                                    <span class="badge bg-dark">
                                        <i class="fas fa-moon me-1"></i>Dark Mode
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-sun me-1"></i>Light Mode
                                    </span>
                                @endif
                            </div>

                            <!-- Color Details -->
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="color-info">
                                        <label class="form-label small text-muted mb-1">Background</label>
                                        <div class="d-flex align-items-center">
                                            <div class="color-swatch me-2"
                                                style="background-color: {{ $themes->background_color }};"></div>
                                            <code class="small">{{ $themes->background_color }}</code>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="color-info">
                                        <label class="form-label small text-muted mb-1">Text Color</label>
                                        <div class="d-flex align-items-center">
                                            <div class="color-swatch me-2"
                                                style="background-color: {{ $themes->text_color }};"></div>
                                            <code class="small">{{ $themes->text_color }}</code>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('theme.edit', $themes->id) }}"
                                    class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('theme.destroy', $themes->id) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                        onclick="return confirm('Yakin ingin hapus tema {{ $themes->name }}?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($theme) == 0)
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-palette fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada tema</h4>
                            <p class="text-muted mb-4">Mulai dengan membuat tema pertama Anda</p>
                            <a href="{{ route('theme.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Tema Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .theme-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .theme-preview {
            height: 120px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
        }

        .preview-content {
            text-align: center;
            width: 100%;
            padding: 20px;
        }

        .preview-window {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .preview-dots {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 8px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            margin-right: 4px;
            opacity: 0.7;
        }

        .preview-text h6 {
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .preview-text p {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .color-swatch {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .color-info code {
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }

        .alert {
            border-radius: 10px;
            border-left: 4px solid #28a745;
        }

        .badge {
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
            border-radius: 20px;
        }

        .empty-state i {
            opacity: 0.5;
        }

        .card-title {
            color: #2d3748;
        }

        .text-gray-800 {
            color: #2d3748 !important;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-lg {
                width: 100%;
            }
        }
    </style>
@endsection
