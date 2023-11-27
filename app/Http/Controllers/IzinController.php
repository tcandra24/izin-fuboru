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
        $keluarIzin = KeluarIzin::where('status', 'T2')->orWhere('status', 'T3')->orderBy('create_date', 'DESC')->paginate(10);
        return view('izin.index', [ 'keluarIzin' => $keluarIzin ]);
    }

    public function update(Request $request)
    {
        try {

            DB::transaction(function() use ($request){
                $kodeIzin = $request->kode_izin;
                $keluarIzin = KeluarIzin::select('kode_izin', 'status', 'keperluan', 'keterangan', 'create_by')->where('kode_izin', $kodeIzin)->first();

                $statusBaru = '';
                if($keluarIzin->status === 'T2'){
                    $statusBaru = 'A';
                }elseif($keluarIzin->status === 'T3'){
                    $statusBaru = 'C';
                }

                KeluarIzin::where('kode_izin', $kodeIzin)->update([
                    'approval_2' => Auth::user()->kode,
                    'status' => $statusBaru
                ]);

                LogApproval::create([
                    'code_approval' => $keluarIzin->kode_izin,
                    'user_app_code' => $keluarIzin->create_by,
                    'title' => $keluarIzin->keperluan,
                    'description' => $keluarIzin->keterangan,
                    'old_status' => $keluarIzin->status,
                    'new_status' => $statusBaru,
                    'user_id' => Auth::user()->id
                ]);
            });

            return redirect()->to('/izin-keluar')->with('success', 'Izin Berhasil Diapprove');
        } catch (\Exception $e) {
            return redirect()->to('/izin-keluar')->with('error', $e->getMessage());
        }
    }
}
