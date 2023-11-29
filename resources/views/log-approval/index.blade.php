@extends('layouts/dashboard')

@section('title')
Log Approval
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Log Approval</h5>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">#</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Kode Izin</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Yang Membuat</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Keperluan</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status Lama</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status Baru</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Di Approve Oleh</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Tanggal</h6>
                </th>
                </tr>
            </thead>
            <tbody>
                @if(count($logApproval) > 0)
                    @foreach($logApproval AS $key => $log)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $logApproval->firstItem() + $key }}</h6></td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->code_approval }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->pengguna_buat_izin->nama }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->title }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->description }}</p>
                            </td>
                            <td class="border-bottom-0">
                                @if($log->old_status === 'T2')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Keluar</span>
                                @elseif($log->old_status === 'T3')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Masuk</span>
                                @elseif($log->old_status === 'A')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Aktif</span>
                                @elseif($log->old_status=== 'C')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Selesai</span>
                                @else
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Status Tidak Ditemukan</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                @if($log->new_status === 'T2')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Keluar</span>
                                @elseif($log->new_status === 'T3')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Masuk</span>
                                @elseif($log->new_status === 'A')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Aktif</span>
                                @elseif($log->new_status=== 'C')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Selesai</span>
                                @else
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Status Tidak Ditemukan</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->user->nama }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $log->created_at }}</p>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">
                            <div class="alert alert-info text-center" role="alert">
                                Log Approval Masih Kosong
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
            </table>
            <div class="d-flex flex-column justify-content-end my-2">
                {{ $logApproval->links() }}
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
