<?php
namespace App\Actions\Contrato;

use Spatie\DataTransferObject\DataTransferObject;

class ContratoDTO extends DataTransferObject
{
    public int $id;
    public int $id_user;
    public int $id_propriedade;
    public string $email;
    public int $id_tipo_pessoa;
    public string $documento;
    public string $nome;

}
