<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'performance';

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'performance_id', 'performance_id');
    }

    public function getPerformanceNameAttribute($value)
    {
        switch ($value) {
            case 'Superior':
                return '<div class="badge badge-info">Superior</div>';
                break;

            case 'Lulus':
                return '<div class="badge badge-success">Lulus</div>';
                break;

            case 'Borderline':
                return '<div class="badge badge-warning">Borderline</div>';
                break;

            case 'Tidak Lulus':
                return '<div class="badge badge-error">Tidak Lulus</div>';
                break;
        }
    }
}
