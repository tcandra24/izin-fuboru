<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluarIzin;

class TransactionsApprovalController extends Controller
{
    public function index()
    {
        $keluarIzin = KeluarIzin::orderBy('create_date', 'DESC')->paginate(10);

        return view('transactions.izin-keluar.index', [ 'keluarIzin' => $keluarIzin ]);
    }
}
