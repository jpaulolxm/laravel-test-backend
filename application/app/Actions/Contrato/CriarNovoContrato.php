<?php
namespace App\Actions\Contrato;

use App\Models\Contrato;


class CriarNovoContrato
{
    public static function create(ContratoDTO $dto): bool
    {
      $model = new Contrato();

      $model->id_user        = $dto->id_user;
      $model->email          = $dto->email;
      $model->id_tipo_pessoa = $dto->id_tipo_pessoa;
      $model->id_propriedade = $dto->id_propriedade;
      $model->documento      = $dto->documento;
      $model->nome           = $dto->nome;

      return $model->save();
    }

}
