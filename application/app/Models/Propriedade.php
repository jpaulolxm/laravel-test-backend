<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property String $id_user
 * @property String $email_proprietario
 * @property String $id_tipo
 * @property String $cep
 * @property String $endereco
 * @property String $numero
 * @property String $bairro
 * @property String $complemento
 * @property String $estado
 * @property String $cidade
 * @property int $id_status
 */
class Propriedade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = [
        'id_user',
    ];

    protected $appends = ['tipo', 'status'];

    public function getTipoAttribute()
    {
        return TipoDePropriedadeEnum::getName($this->id_tipo);
    }

    public function getStatusAttribute()
    {
        return StatusPropriedadeEnum::getName($this->id_status);
    }

    public function user (): HasOne
    {
        return $this->hasOne(User::class, 'id','id_user');
    }
}
