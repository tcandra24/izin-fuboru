@extends('layouts/dashboard')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="alert alert-info solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                    <strong>Selamat Datang!</strong> {{ ucwords(strtolower(Auth::user()->nama)) }}.
                </div>
                <div class="alert alert-info solid alert-dismissible fade show">
                    <p>Dimohon untuk mengganti password jika password masih menggunakan password yang diberikan oleh Administrator</p>
                    <p>Untuk mengganti password bisa klik inisial nama pada pojok kanan atas dan pilih menu "Ganti Password"</p>
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
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
@endsection
