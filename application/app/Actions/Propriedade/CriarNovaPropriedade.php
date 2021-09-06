<?php
namespace App\Actions\Propriedade;

use App\Models\Propriedade;


class CriarNovaPropriedade
{
    public static function create(PropriedadeDTO $dto): bool
    {
      $model = new Propriedade();

      $model->id_user            = $dto->id_user;
      $model->email_proprietario = $dto->email_proprietario;
      $model->id_tipo            = $dto->id_tipo;
      $model->cep                = $dto->cep;
      $model->endereco           = $dto->endereco;
      $model->numero             = $dto->numero;
      $model->bairro             = $dto->bairro;
      $model->complemento        = $dto->complemento;
      $model->estado             = $dto->estado;
      $model->cidade             = $dto->cidade;
      $model->id_status          = 1;

      return $model->save();
    }

}
