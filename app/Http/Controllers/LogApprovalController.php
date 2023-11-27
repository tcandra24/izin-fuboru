<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogApproval;

class LogApprovalController extends Controller
{
    public function index()
    {
        $logApproval = LogApproval::with('user')->orderBy('created_at', 'DESC')->paginate(10);

        return view('log-approval.index', [ 'logApproval' => $logApproval ]);
    }
}
