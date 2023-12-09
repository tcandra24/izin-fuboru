<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\KeluarIzin;
use App\Models\LogApproval;


class IzinController extends Controller
{
    public function index()
    {
        if(strtolower(Auth::user()->jabatan) === 'satpam') {
            $keluarIzin = KeluarIzin::where('status', 'T2')->orWhere('status', 'T3')->orderBy('create_date', 'DESC')->paginate(10);
        } elseif(strtolower(Auth::user()->jabatan) === 'hrga') {
            $keluarIzin = KeluarIzin::where('status', 'T1')->orderBy('create_date', 'DESC')->paginate(10);
        } else {
            // Jabatan Admin
            $keluarIzin = KeluarIzin::where('status', 'T1')->where('status', 'T2')->orWhere('status', 'T3')->orderBy('create_date', 'DESC')->paginate(10);
        }
        return view('izin.index', [ 'keluarIzin' => $keluarIzin ]);
    }

    public function edit($kodeIzin)
    {
        try {
            $kodeIzin = str_replace('-', '/', $kodeIzin);
            $keluarIzin = KeluarIzin::where('kode_izin', $kodeIzin)->first();

            return view('izin.edit', ['keluarIzin' => $keluarIzin]);
        } catch (\Exception $e) {
            return redirect()->to('/izin-keluar')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $isApprove = (int)$request->is_approve;

            if($request->approve_mode === 'satpam') {
                DB::transaction(function() use ($request, $isApprove){
                    $kodeIzin = $request->kode_izin;
                    $keluarIzin = KeluarIzin::select('kode_izin', 'status', 'keperluan', 'keterangan', 'create_by', 'kembali')->where('kode_izin', $kodeIzin)->first();

                    $statusBaru = '';
                    if($keluarIzin->status === 'T2'){
                        if($isApprove){
                            if($keluarIzin->kembali){
                                $statusBaru = 'A';
                            } else {
                                $statusBaru = 'C';
                            }
                        } else {
                            $statusBaru = 'C';
                        }

                    }elseif($keluarIzin->status === 'T3'){
                        $statusBaru = 'C';
                    }

                    KeluarIzin::where('kode_izin', $kodeIzin)->update([
                        'approval_2'    => Auth::user()->kode,
                        'status'        => $statusBaru
                    ]);

                    LogApproval::create([
                        'code_approval' => $keluarIzin->kode_izin,
                        'user_app_code' => $keluarIzin->create_by,
                        'title'         => $keluarIzin->keperluan,
                        'description'   => $keluarIzin->keterangan,
                        'old_status'    => $keluarIzin->status,
                        'new_status'    => $statusBaru,
                        'user_id'       => Auth::user()->id
                    ]);
                });

                if ($isApprove){
                    return redirect()->to('/izin-keluar')->with('success', 'Izin Berhasil Diapprove');
                }else {
                    return redirect()->to('/izin-keluar')->with('success', 'Izin Berhasil DiTolak');
                }
            } elseif ($request->approve_mode === 'hrga') {
                DB::transaction(function() use ($request){
                    $kodeIzin = $request->kode_izin;
                    $keluarIzin = KeluarIzin::select('kode_izin', 'status', 'keperluan', 'keterangan', 'create_by')->where('kode_izin', $kodeIzin)->first();

                    KeluarIzin::where('kode_izin', $kodeIzin)->update([
                        'approval_1' => Auth::user()->kode,
                        'status' => 'T2',
                        'kembali' => $request->kembali,
                    ]);

                    LogApproval::create([
                        'code_approval' => $keluarIzin->kode_izin,
                        'user_app_code' => $keluarIzin->create_by,
                        'title' => $keluarIzin->keperluan,
                        'description' => $keluarIzin->keterangan,
                        'old_status' => $keluarIzin->status,
                        'new_status' => 'T2',
                        'user_id' => Auth::user()->id
                    ]);

                });

                return redirect()->to('/izin-keluar')->with('success', 'Izin Berhasil Diapprove');
            } else {
                return redirect()->to('/izin-keluar')->with('error', 'Silahkan Hubungi Administrator!');
            }
        } catch (\Exception $e) {
            return redirect()->to('/izin-keluar')->with('error', $e->getMessage());
        }
    }
}
