<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $table = 'station';
    protected $guarded = ['id'];

    public function kriteria(): HasMany
    {
        return $this->hasMany(Kriteria::class, 'station_id', 'no_station');
    }

}
