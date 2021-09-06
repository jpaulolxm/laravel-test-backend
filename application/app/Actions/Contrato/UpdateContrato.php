<?php
namespace App\Actions\Contrato;

use App\Models\Contrato;


class UpdateContrato
{
    public static function update(ContratoDTO $dto): bool
    {
        /**
        * @var Contrato $model
        */

        $model = Contrato::findOrFail($dto->id);

        $model->id_user        = $dto->id_user;
        $model->email          = $dto->email;
        $model->id_tipo_pessoa = $dto->id_tipo_pessoa;
        $model->id_propriedade = $dto->id_propriedade;
        $model->documento      = $dto->documento;
        $model->nome           = $dto->nome;

      return $model->save();
    }

}
