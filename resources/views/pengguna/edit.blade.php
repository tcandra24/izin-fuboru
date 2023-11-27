@extends('layouts/dashboard')

@section('title')
Edit Pengguna
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap-5-theme.min.css') }}" />
    <style>
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,.select2-container--bootstrap-5.select2-container--open .select2-selection {
            box-shadow: unset !important;
        }
    </style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Pengguna</h5>
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show m-2">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Error!</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    <span><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif
        <form method="POST" action="{{ url('/pengguna/'.$pengguna->id) }}">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $pengguna->nama }}" aria-describedby="nama">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{ $pengguna->jabatan }}" aria-describedby="jabatan">
                        @error('jabatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="noHp" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="noHp" value="{{ $pengguna->email }}" aria-describedby="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="kode" class="form-label">Kode Di App</label>
                        <select name="kode" class="form-control" id="kode" aria-describedby="kode">
                            <option value="">Pilih Kode</option>
                            @foreach($penggunaApp AS $p)
                                <option value="{{ $pengguna->kode }}" {{ $pengguna->kode === $p->kode ? 'selected' : '' }}>
                                    {{ $pengguna->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="roles" class="form-label">Role</label>
                        <select name="roles[]" class="form-control" id="roles" aria-describedby="roles" multiple="multiple">
                            <option value="">Pilih Role</option>
                            @foreach($roles AS $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $pengguna->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>

<script>
    $('#kode').select2({
        theme: 'bootstrap-5'
    })

    $('#roles').select2({
        theme: 'bootstrap-5'
    })
</script>
@endsection
