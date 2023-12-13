@extends('layouts/dashboard')

@section('title')
Transaksi Izin Keluar
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Daftar Izin Keluar</h5>
                <div class="row">
                    <form action="{{ url('/transactions/izin-keluar') }}">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-stretch">
                                <div class="mb-3 w-100">
                                    <label for="dateStart" class="form-label">Tanggal Awal</label>
                                    <input type="date" name="start_date" class="form-control" id="dateStart" value="{{ Request::get('start_date') }}" aria-describedby="dateStart">
                                </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-stretch">
                                <div class="mb-3 w-100">
                                    <label for="dateEnd" class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="end_date" class="form-control" id="dateEnd" value="{{ Request::get('end_date') }}" aria-describedby="dateEnd">
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="mb-3 w-100">
                                    <div class="d-flex" style="margin-top: 30px;gap: 10px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="/transactions/izin-keluar" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="d-flex" style="gap: 10px;">
                        <form action="{{ url('/report/izin-keluar/export') }}">
                            <input type="hidden" name="start_date" value="{{ Request::has('start_date') ? Request::get('start_date') : '' }}" required>
                            <input type="hidden" name="end_date" value="{{ Request::has('end_date') ? Request::get('end_date') : '' }}" required>
                            <button type="submit" class="btn btn-success">Export To Excel</button>
                        </form>
                        <form action="{{ url('/report/izin-keluar/pdf') }}">
                            <input type="hidden" name="start_date" value="{{ Request::has('start_date') ? Request::get('start_date') : '' }}" required>
                            <input type="hidden" name="end_date" value="{{ Request::has('end_date') ? Request::get('end_date') : '' }}" required>
                            <button type="submit" class="btn btn-danger">Export To PDF</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Kode Izin</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Yang Membuat</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Waktu Izin</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Waktu Kembali</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Keperluan</h6>
                                </th>
                                <th class="border-bottom-0" colspan="2">
                                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Approval 1</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Approval 2</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($keluarIzin) > 0)
                                @foreach($keluarIzin AS $key => $izin)
                                    <tr>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $keluarIzin->firstItem() + $key }}</h6></td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->kode_izin }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->pengguna_buat_izin->nama }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($izin->waktu_izin)->locale('id')->translatedFormat('l, d F Y - H:m') }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($izin->waktu_kembali)->locale('id')->translatedFormat('l, d F - Y H:m') }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->keperluan }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->keterangan }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            @isset($izin->kembali)
                                                @if($izin->kembali)
                                                    <span class="badge rounded-pill bg-warning text-white fw-bold">Kembali</span>
                                                @else
                                                    <span class="badge rounded-pill bg-warning text-white fw-bold">Tidak Kembali</span>
                                                @endif
                                            @else
                                                <span class="badge rounded-pill bg-warning text-white fw-bold">Status Tidak Ditemukan</span>
                                            @endisset
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->pengguna_approval_1->nama ?? '-' }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $izin->pengguna_approval_2->nama ?? '-' }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if($izin->status === 'T1')
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Approve Keluar (HRGA)</span>
                                            @elseif($izin->status === 'T2')
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Approve Keluar (Satpam)</span>
                                            @elseif($izin->status === 'T3')
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Approve Masuk (Satpam)</span>
                                            @elseif($izin->status === 'A')
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Aktif</span>
                                            @elseif($izin->status=== 'C')
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Selesai</span>
                                            @else
                                                <span class="badge rounded-pill bg-info text-white fw-bold">Status Tidak Ditemukan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11">
                                        <div class="alert alert-info text-center" role="alert">
                                            Daftar Izin Masih Kosong
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        </table>
                        <div class="d-flex flex-column justify-content-end my-2">
                            {{ $keluarIzin->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection
