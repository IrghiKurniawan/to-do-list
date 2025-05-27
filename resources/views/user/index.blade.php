@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="text-primary">
                    <i class="fas fa-users me-2"></i>Kelola Akun
                </h2>
                <p class="text-muted">Manajemen akun pengguna sistem</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end align-items-center">
                    <form class="d-flex me-3" action="{{ route('kelola_akun.data') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="cari" placeholder="Cari nama akun..." 
                                   class="form-control" value="{{ request('cari') }}">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('kelola_akun.tambah') }}" class="btn btn-success">
                        <i class="fas fa-user-plus me-1"></i>Tambah Akun
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Data Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-table me-2"></i>Daftar Akun
                    <span class="badge bg-primary ms-2">{{ $users->total() }} Total</span>
                </h5>
            </div>
            <div class="card-body p-0">
                @if (count($users) == 0)
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data akun</h5>
                        <p class="text-muted">
                            @if(request('cari'))
                                Pencarian "{{ request('cari') }}" tidak ditemukan.
                                <br>
                                <a href="{{ route('kelola_akun.data') }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-times me-1"></i>Hapus Filter
                                </a>
                            @else
                                Belum ada akun yang terdaftar di sistem.
                            @endif
                        </p>
                    </div>
                @else
                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th><i class="fas fa-user me-1"></i>Nama</th>
                                    <th><i class="fas fa-envelope me-1"></i>Email</th>
                                    <th class="text-center"><i class="fas fa-user-tag me-1"></i>Role</th>
                                    <th class="text-center" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $item)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">
                                                {{ ($users->currentPage() - 1) * $users->perpage() + ($index + 1) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <span class="text-white fw-bold">
                                                        {{ strtoupper(substr($item['name'], 0, 1)) }}
                                                    </span>
                                                </div>
                                                {{ $item['name'] }}
                                            </div>
                                        </td>
                                        <td>{{ $item['email'] }}</td>
                                        <td class="text-center">
                                            @switch($item['role'])
                                                @case('admin')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-crown me-1"></i>Admin
                                                    </span>
                                                    @break
                                                @case('user')
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-user me-1"></i>User
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ $item['role'] }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('kelola_akun.ubah', $item['id']) }}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit Akun">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger btn-sm" 
                                                        onclick="showModalDelete('{{ $item->id }}','{{ $item->name }}')"
                                                        data-bs-toggle="tooltip" 
                                                        title="Hapus Akun">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($users->hasPages())
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} 
                            dari {{ $users->total() }} data
                        </small>
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Hapus Akun -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                        <p class="mb-2">Apakah Anda yakin ingin menghapus akun:</p>
                        <strong class="text-primary" id="nama_akun"></strong>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <small>Tindakan ini tidak dapat dibatalkan!</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
    }
    
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
</style>
@endpush

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function showModalDelete(id, name) {
            $('#nama_akun').text(name);
            $('#deleteModal').modal('show');
            let url = "{{ route('kelola_akun.hapus' , ':id')}}";
            url = url.replace(':id', id);
            $("form").attr('action', url);
        }

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endpush