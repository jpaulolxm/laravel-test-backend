<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_propriedade
 * @property integer $id_tipo_pessoa
 * @property integer $documento
 * @property integer $email
 * @property integer $nome
 */

class Contrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at'  => 'date:d/m/Y H:i:s',
    ];

    protected $appends = ['tipo_pessoa'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Contrato $model)
        {
            $propriedade = Propriedade::find($model->id_propriedade);

            $propriedade->id_status = StatusPropriedadeEnum::CONTRATADO;

            $propriedade->save();
        });

        static::updated(function (Contrato $model)
        {
            $propriedade = Propriedade::find($model->id_propriedade);

            $propriedade->id_status = StatusPropriedadeEnum::CONTRATADO;

            $propriedade->save();

        });
    }

    public function getTipoPessoaAttribute()
    {
        return TipoDePessoaEnum::getName($this->id_tipo_pessoa);
    }

    public function propriedade (): HasOne
    {
        return $this->hasOne(Propriedade::class, 'id','id_propriedade');
    }

    public function user (): HasOne
    {
        return $this->hasOne(User::class, 'id','id_user');
    }
}
