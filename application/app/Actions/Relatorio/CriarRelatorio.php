<?php
namespace App\Actions\Relatorio;


use App\Actions\Relatorio\Jobs\RelatorioJob;
use App\Models\Relatorio;
use App\Models\StatusRelatorioEnum;

class CriarRelatorio
{

    public function create(RelatorioDTO $DTO)
    {
        $relatorio = new Relatorio();

        $relatorio->id_status = StatusRelatorioEnum::PROCESSANDO;
        $relatorio->id_user   = $DTO->idUser;
        $relatorio->path      = '';
        $relatorio->descricao = "Data Inicial : ".$DTO->dataInicial.", Data Final: ".$DTO->dataFinal;

        $relatorio->save();

        $DTO->idRelatorio = $relatorio->id;

        RelatorioJob::dispatch($DTO);


    }

}
