<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogApproval extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_approval',
        'user_app_code',
        'title',
        'description',
        'old_status',
        'new_status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pengguna_buat_izin()
    {
        return $this->belongsTo(UserApp::class, 'user_app_code', 'kode');
    }
}
