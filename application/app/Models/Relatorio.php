<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $id_user
 * @property integer $path
 * @property integer $descricao
 * @property integer $id_status
 */

class Relatorio extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'date:d/m/Y H:i:s',
    ];

    protected array $appends = ['status'];



    public function getStatusAttribute()
    {
        return StatusRelatorioEnum::getName($this->id_status);
    }
}
