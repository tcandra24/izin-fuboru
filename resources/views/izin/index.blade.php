@extends('layouts/dashboard')

@section('title')
Izin Keluar
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Daftar Izin Keluar</h5>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show m-2">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    <span><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show m-2">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Error!</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    <span><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
        @endif
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
                    <th class="border-bottom-0">
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
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Action</h6>
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
                                <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($izin->waktu_kembali)->locale('id')->translatedFormat('l, d F Y - H:m') }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $izin->keperluan }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $izin->keterangan }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $izin->pengguna_approval_1->nama ?? '-' }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ $izin->pengguna_approval_2->nama ?? '-' }}</p>
                            </td>
                            <td class="border-bottom-0">
                                @if($izin->status === 'T2')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Keluar</span>
                                @elseif($izin->status === 'T3')
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Approve Masuk</span>
                                @else
                                    <span class="badge rounded-pill bg-info text-white fw-bold">Status Tidak Ditemukan</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-primary m-1 btn-approve" data-kode="{{ str_replace('/', '-', $izin->kode_izin) }}" data-keterangan="{{ $izin->keterangan }}" data-keperluan="{{ $izin->keperluan }}">Approve</button>

                                    <form id="form-approve-izin-{{ str_replace('/', '-', $izin->kode_izin) }}" method="POST" action=" {{ url('/izin-keluar/') }}">
                                        @csrf
                                        <input type="hidden" name="kode_izin" value="{{ $izin->kode_izin }}">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">
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
@endsection

@section('script')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $('.btn-approve').on('click', function(){
      const kode = $(this).attr('data-kode')
      const keperluan = $(this).attr('data-keperluan')
      const keterangan = $(this).attr('data-keterangan')

      Swal.fire({
        title: `Yakin Approve Izin ${keperluan} ?`,
        text: keterangan,
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: !1
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-approve-izin-' + kode).submit()
        }
      })

    })
</script>
@endsection
