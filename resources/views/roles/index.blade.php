@extends('layouts/dashboard')

@section('title')
Role
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Daftar Role</h5>
        <a href="/roles/create" class="btn btn-primary m-1">Tambah</a>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Ijin</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Action</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(count($roles) > 0)
                    @foreach($roles AS $key => $role)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $roles->firstItem() + $key }}</h6></td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{ ucwords($role->name) }}</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="row">
                                    <div class="d-flex align-items-center gap-2 flex-wrap" style="min-width: 200px;">
                                        @foreach($role->permissions AS $permission)
                                            <span class="badge bg-success rounded-3 fw-semibold">{{ $permission->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="/roles/{{ $role->id }}/edit" class="btn btn-success m-1">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-info text-center" role="alert">
                                Role Masih Kosong
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
            </table>
            <div class="d-flex flex-column justify-content-end my-2">
                {{ $roles->links() }}
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
