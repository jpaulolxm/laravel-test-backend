<?php

namespace App\Actions\Relatorio\Jobs;

use App\Actions\Relatorio\RelatorioDTO;
use App\Models\Contrato;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;


class RelatorioExportExcel  extends StringValueBinder implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping,ShouldAutoSize, WithEvents , WithCustomValueBinder
{
    private RelatorioDTO $DTO;

    public function __construct(RelatorioDTO $DTO)
    {
        $this->DTO = $DTO;
    }



    public function headings(): array
    {
        return [
            'ID',
            'Email Contratante',
            'Contratante',
            'Tipo de Pessoa',
            'Documento',
            'PROPRIEDADE',
            'Proprietário',
            'CRIADO EM',
            'LOGIN'
        ];
    }

    /**
     * @return Collection
     * @throws Exception
     */
    public function collection(): Collection
    {
        return  Contrato::with(['propriedade', 'user'])
                        ->whereDate('created_at', '>=',$this->DTO->dataInicial)
                        ->whereDate('created_at', '<=', $this->DTO->dataFinal)
                        ->get();

    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'H' => 'dd/mm/yyyy H:i',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function(BeforeExport $event)
            {
                $event->writer->getProperties()->setCreator('JPAULOLXM');
            },
            AfterSheet::class    => function(AfterSheet $event)
            {
                $cellRangeHeaders = 'A1:AX1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRangeHeaders)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRangeHeaders)->getFont()->setBold(true);


            },
        ];
    }

    public function map($row): array
    {
        /**
         * @var Contrato $row
         */

        return [
            $row->id,
            $row->email,
            $row->nome,
            $row->tipo_pessoa,
            $row->documento,
            $row->propriedade->endereco.', '.$row->propriedade->estado.'- '.$row->propriedade->cidade,
            $row->propriedade->email_proprietario,
            $row->created_at,
            $row->user->email,

        ];
    }
}
