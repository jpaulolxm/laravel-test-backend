<?php
namespace App\Actions\Relatorio;

use Spatie\DataTransferObject\DataTransferObject;

class RelatorioDTO extends DataTransferObject
{

    public ?int $idRelatorio;
    public ?int $idUser;
    public string $dataInicial;
    public string $dataFinal;


}
