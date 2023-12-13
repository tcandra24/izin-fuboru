<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\KeluarIzin;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IzinKeluarExport;

class TransactionsApprovalController extends Controller
{
    public function index(Request $request)
    {

        $keluarIzin = KeluarIzin::where('kode_izin', '<>', '');
        if(isset($request->start_date)){
            $keluarIzin = $keluarIzin->whereDate('create_date', '>=', $request->start_date);
        }

        if(isset($request->end_date)){
            $keluarIzin = $keluarIzin->whereDate('create_date', '<=', $request->end_date);
        }

        $keluarIzin = $keluarIzin->orderBy('create_date', 'DESC')->paginate(10);

        return view('transactions.izin-keluar.index', [ 'keluarIzin' => $keluarIzin ]);
    }

    public function pdf(Request $request)
    {
        $izinKeluar = KeluarIzin::where('kode_izin', '<>', '');
        if(isset($request->start_date)){
            $izinKeluar = $izinKeluar->whereDate('create_date', '>=', $request->start_date);
        }

        if(isset($request->end_date)){
            $izinKeluar = $izinKeluar->whereDate('create_date', '<=', $request->end_date);
        }

        $izinKeluar = $izinKeluar->orderBy('create_date', 'DESC')->get();
        $dateStart = $request->start_date;
        $dateEnd = $request->end_date;

        $pdf = PDF::loadView('exports.izin-keluar', compact('izinKeluar', 'dateStart', 'dateEnd'))->setPaper('a4', 'landscape');

        return $pdf->stream($this->getFileName($request) . '.pdf');
    }

    public function excel(Request $request)
    {
        return Excel::download(new IzinKeluarExport($request->start_date, $request->end_date), $this->getFileName($request) . '.xlsx');
    }

    private function getFileName($request)
    {
        if(isset($request->start_date) && isset($request->end_date)){
            return 'izin keluar : '.$request->start_date.' — '.$request->end_date;
        }

        return 'izin keluar';
    }
}
