<?php

namespace App\Models;

use App\Models\Station;
use App\Models\Kompetensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'kriteria';

    public function daftarKompetensi(): HasOne
    {
        return $this->hasOne(Kompetensi::class, 'kompetensi_id', 'kompetensi_id');
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
}
