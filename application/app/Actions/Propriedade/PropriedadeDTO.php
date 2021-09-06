<?php
namespace App\Actions\Propriedade;

use Spatie\DataTransferObject\DataTransferObject;

class PropriedadeDTO extends DataTransferObject
{
    public int $id;
    public int $id_user;
    public string $email_proprietario;
    public int $id_tipo;
    public string $cep;
    public string $endereco;
    public string $numero;
    public string $bairro;
    public ?string $complemento;
    public string $estado;
    public string $cidade;


}
