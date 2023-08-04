<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $table = 'developer_cvs';

    protected $fillable = [
        'title',
        'file',
        'link',
        'user_id',
    ];
}
