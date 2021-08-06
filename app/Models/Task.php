<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'for_user',
        'created_by',
        'status'
    ];


    public function forUser()
    {
        return $this->belongsTo(User::class, 'id', 'for_user');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

}
