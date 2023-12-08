<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluarIzin extends Model
{
    use HasFactory;
    protected $table = 'keluar_izin';
    public $timestamps = false;

    protected $fillable = [
        'approval_1',
        'approval_2',
        'kembali',
    ];

    public function pengguna_approval_1()
    {
        return $this->belongsTo(UserApp::class, 'approval_1', 'kode');
    }

    public function pengguna_approval_2()
    {
        return $this->belongsTo(User::class, 'approval_2', 'kode');
    }

    public function pengguna_buat_izin()
    {
        return $this->belongsTo(UserApp::class, 'create_by', 'kode');
    }
}
