<?php
namespace App\Actions\Relatorio;


use App\Actions\Relatorio\Jobs\RelatorioJob;
use App\Models\Relatorio;
use App\Models\StatusRelatorioEnum;
use Illuminate\Support\Carbon;

class CriarRelatorio
{

    public function create(RelatorioDTO $DTO)
    {
        $relatorio = new Relatorio();

        $relatorio->id_status = StatusRelatorioEnum::PROCESSANDO;
        $relatorio->id_user   = $DTO->idUser;
        $relatorio->path      = '';
        $relatorio->descricao = "Data Inicial : ". Carbon::createFromFormat('Y-m-d', $DTO->dataInicial)->format('d/m/Y').
                                ", Data Final : ". Carbon::createFromFormat('Y-m-d', $DTO->dataFinal)->format('d/m/Y');

        $relatorio->save();

        $DTO->idRelatorio = $relatorio->id;

        RelatorioJob::dispatch($DTO);


    }

}
