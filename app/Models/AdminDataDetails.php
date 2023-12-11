<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDataDetails extends Model
{
    use HasFactory;
    protected $table = 'admin_data_details';

    protected $fillable = [
        'admin_username',
        'admin_password',
    ];

}
