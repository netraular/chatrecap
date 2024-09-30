<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
        'path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }
}