<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // Daftarkan semua kolom yang boleh diisi
    protected $fillable = [
        'title', 
        'label', 
        'description', 
        'content', 
        'image', 
        'col_span', 
        'row_span'
    ];
}