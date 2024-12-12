<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompetensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kompetensi';

    public function kriteria(): HasOne
    {
        return $this->hasOne(Kriteria::class, 'kompetensi_id', 'kompetensi_id');
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'kompetensi_id', 'kompetensi_id');
    }
}
