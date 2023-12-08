@extends('layouts/dashboard')

@section('title')
Approve HRGA
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
        <h5 class="card-title fw-semibold mb-4">Aproval HRGA</h5>
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show m-2">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Error!</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    <span><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif
        <form method="POST" action="{{ url('/izin-keluar/') }}">
            @csrf
            <input type="hidden" name="kode_izin" value="{{ $keluarIzin->kode_izin }}">
            <input type="hidden" name="approve_mode" value="hrga">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $keluarIzin->pengguna_buat_izin->nama }}" aria-describedby="kodeIzin" disabled>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="nama" class="form-label">Kode Izin</label>
                        <input type="text" name="kodeIzin" class="form-control" id="nama" value="{{ $keluarIzin->kode_izin }}" aria-describedby="kodeIzin" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="jabatan" class="form-label">Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" id="jabatan" value="{{ $keluarIzin->keperluan }}" aria-describedby="keperluan" disabled>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="jabatan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="5" aria-describedby="keperluan" disabled>{{ $keluarIzin->keterangan }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="nama" class="form-label">Waktu Izin</label>
                        <input type="text" name="waktuIzin" class="form-control" id="nama" value="{{ \Carbon\Carbon::parse($keluarIzin->waktu_izin)->locale('id')->translatedFormat('l, d F Y - H:m') }}" aria-describedby="waktuIzin" disabled>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <label for="jabatan" class="form-label">Waktu Kembali</label>
                        <input type="text" name="waktuKembali" class="form-control" id="jabatan" value="{{ \Carbon\Carbon::parse($keluarIzin->waktu_kembali)->locale('id')->translatedFormat('l, d F Y - H:m') }}" aria-describedby="waktuKembali" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="mb-3 w-100">
                        <div class="d-flex" style="gap: 15px;">
                            <div class="form-check">
                                <input class="form-check-input" name="kembali" value="1" type="radio" aria-describedby="term-condition" checked>
                                <label for="term-condition" class="form-label">Kembali</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="kembali" value="0" type="radio" aria-describedby="term-condition">
                                <label for="term-condition" class="form-label">Tidak Kembali</label>
                            </div>
                        </div>
                        @error('kembali')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Approve</button>
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
