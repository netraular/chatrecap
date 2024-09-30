<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'csv_upload_id',
        'query',
        'response',
    ];

    public function csvUpload()
    {
        return $this->belongsTo(CsvUpload::class);
    }
}