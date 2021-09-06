<?php

namespace App\Http\Requests;

use App\Actions\Relatorio\RelatorioDTO;
use Illuminate\Foundation\Http\FormRequest;


/**
 * @property String $dataInicial
 * @property String $dataFinal
 */

class RelatorioFormRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'dataInicial' => 'required|date',
            'dataFinal'   => 'required|date',
        ];
    }

    public function data(): RelatorioDTO
    {
        return new RelatorioDTO
        ([
            'dataInicial'  => $this->dataInicial,
            'dataFinal'    => $this->dataFinal,
            'idUser'      => auth()->id(),

        ]);
    }
}
