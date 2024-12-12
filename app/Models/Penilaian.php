<?php

namespace App\Models;

use App\Models\Periode;
use App\Models\Performance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'penilaian';

    public function performance(): HasOne
    {
        return $this->hasOne(Performance::class, 'performance_id', 'performance_id');
    }

    public function periodeName(): HasOne
    {
        return $this->hasOne(Periode::class, 'slug_periode', 'periode');
    }
}
