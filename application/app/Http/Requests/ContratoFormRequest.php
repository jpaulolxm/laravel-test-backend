<?php

namespace App\Http\Requests;

use App\Actions\Contrato\ContratoDTO;
use App\Models\Propriedade;
use App\Models\StatusPropriedadeEnum;
use App\Models\TipoDePessoaEnum;
use Illuminate\Foundation\Http\FormRequest;
use Servicos\Models\Periodo\ServicosIndexPeriodo;


/**
 * @property integer $id
 * @property integer $propriedade
 * @property integer $tipo_pessoa
 * @property String $email
 * @property String $nome
 * @property String $cpf
 * @property String $cnpj

 */


class ContratoFormRequest extends FormRequest
{
    public string $documento = '';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }


    public function rules() : array
    {
        $rule =  [
            'id'             => 'numeric',
            'propriedade'    => ['required', 'numeric', 'min:1', $this->estaDisponivelPropriedade()],
            'email'          => 'required|email',
            'nome'           => 'required|string',
            'tipo_pessoa'    => 'required|numeric',
        ];

        if($this->tipo_pessoa === TipoDePessoaEnum::FISICA)
        {
            $rule['cpf']     = 'required|cpf';
            $this->documento = $this->cpf;
        }

        if($this->tipo_pessoa === TipoDePessoaEnum::JURIDICA)
        {
            $rule['cnpj']    = 'required|cnpj';
            $this->documento = $this->cnpj;
        }

        return $rule;
    }

    private function estaDisponivelPropriedade()
    {
        return function ($attribute, $value, $fail)
        {
              $propriedade = Propriedade::where('id', '=', $this->propriedade)
                                        ->where('id_status', '=', StatusPropriedadeEnum::CONTRATADO)
                                        ->first();

                if ($propriedade)
                {
                    $fail('Propriedade já se encontra em Contrato');
                }

        };
    }

    public function data(): ContratoDTO
    {
        return new ContratoDTO
        ([
            'id'             => (int) $this->id,
            'id_user'        => (int) auth()->id(),
            'id_propriedade' => (int) $this->propriedade,
            'email'          => $this->email,
            'nome'           => $this->nome,
            'id_tipo_pessoa' => (int) $this->tipo_pessoa,
            'documento'      => $this->documento,
        ]);
    }
}
