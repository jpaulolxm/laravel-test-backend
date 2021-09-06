<?php

namespace App\Actions\Relatorio\Jobs;

use App\Actions\Relatorio\RelatorioDTO;
use App\Models\Relatorio;
use App\Models\StatusRelatorioEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;


class RelatorioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public RelatorioDTO $DTO;

    public function __construct(RelatorioDTO $DTO )
    {
        $this->DTO = $DTO;
    }


    public function handle()
    {
        $path = 'relatorio/'.$this->DTO->idRelatorio.'-relatorio-contratos.xlsx';

        Excel::store(new RelatorioExportExcel($this->DTO), $path);

        $this->updateStatus(StatusRelatorioEnum::CONCLUIDO, $path);
    }

    public function fail($exception = null)
    {
        $this->updateStatus(StatusRelatorioEnum::ERROR);
    }

    public function updateStatus(int $status, string $path = '')
    {
        /**
         * @var Relatorio $relatorio
         */

        $relatorio = Relatorio::find($this->DTO->idRelatorio);

        if($path)
        {
            $relatorio->path = $path;
        }

        $relatorio->id_status = $status;

        $relatorio->save();
    }


}
