<?php

namespace App\Exports;

use App\Models\KeluarIzin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IzinKeluarExport implements FromView
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    public function view(): View
    {
        $keluarIzin = KeluarIzin::where('kode_izin', '<>', '');
        if($this->start_date && $this->end_date){
            $keluarIzin = $keluarIzin->whereDate('create_date', '>=', $this->start_date)->whereDate('create_date', '<=', $this->end_date);
        }

        $keluarIzin = $keluarIzin->orderBy('create_date', 'DESC')->get();

        return view('exports.izin-keluar', [
            'izinKeluar' => $keluarIzin,
            'dateStart' => $this->start_date,
            'dateEnd' => $this->end_date
        ]);
    }
}
