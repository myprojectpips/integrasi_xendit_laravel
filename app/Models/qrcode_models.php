<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcode_models extends Model {
    protected $table = "tb_qrcode";
    protected $guarded = [];
    
    use HasFactory;
}
