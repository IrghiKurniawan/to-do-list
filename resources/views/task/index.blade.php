@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex justify-content-between flex-wrap align-items-center mb-4 gap-2">
                    <h2 class="text-primary mb-0">
                        <i class="fas fa-tasks me-2"></i>Daftar Tugas
                    </h2>

                    <div class="d-flex gap-2 flex-wrap">
                        {{-- Form Pencarian --}}
                        <form action="{{ route('task.index') }}" method="GET" class="d-flex">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" placeholder="Cari tugas..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                        {{-- Tombol Tambah --}}
                        <a href="{{ route('task.create') }}" class="btn btn-success d-flex align-items-center shadow-sm">
                            <i class="fas fa-plus me-2"></i>Tambah Tugas
                        </a>
                    </div>
                </div>

                @if ($task->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($task as $tasks)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            @if ($tasks->is_done)
                                                <form action="{{ route('task.toggle', $tasks->id) }}" method="POST" class="me-3">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge bg-success border-0" style="cursor:pointer;">
                                                        <i class="fas fa-check me-1"></i>Selesai
                                                    </button>
                                                </form>
                                                <strong class="text-decoration-line-through text-muted">
                                                    {{ $tasks->title }}
                                                </strong>
                                            @else
                                                <form action="{{ route('task.toggle', $tasks->id) }}" method="POST" class="me-3">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge bg-warning text-dark border-0"
                                                        style="cursor:pointer;">
                                                        <i class="fas fa-clock me-1"></i>Belum
                                                    </button>
                                                </form>
                                                <strong class="text-dark">{{ $tasks->title }}</strong>
                                            @endif
                                        </div>


                                        <div class="gap-2" role="group">
                                            @if ($tasks->attachment)
                                                <a href="{{ asset('attachments/' . $tasks->attachment) }}"
                                                    class="btn btn-sm btn-outline-secondary" target="_blank">
                                                    <i class="fas fa-paperclip me-1"></i>Lampiran
                                                </a>
                                            @endif

                                            {{-- <form action="{{ route('task.toggle', $tasks->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm {{ $tasks->is_done ? 'btn-success' : 'btn-warning' }}">
                                                    <i
                                                        class="fas {{ $tasks->is_done ? 'fa-check' : 'fa-hourglass-half' }} me-1"></i>
                                                    {{-- {{ $tasks->is_done ? '✓' : '-' }} 
                                                </button>
                                            </form> --}}

                                            <a href="{{ route('task.edit', $tasks->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('task.destroy', $tasks->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada tugas</h5>
                            <p class="text-muted mb-3">Mulai dengan menambahkan tugas pertama Anda</p>
                            <a href="{{ route('task.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Tambah Tugas Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection