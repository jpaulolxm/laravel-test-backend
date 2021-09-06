<?php

namespace App\Http\Requests;

use App\Actions\Propriedade\PropriedadeDTO;
use Illuminate\Foundation\Http\FormRequest;



/**
 * @property integer $id
 * @property String $email_proprietario
 * @property String $tipo_imovel
 * @property String $cep
 * @property String $endereco
 * @property String $numero
 * @property String $bairro
 * @property String $complemento
 * @property String $estado
 * @property String $cidade
 */


class PropriedadeFormRequest extends FormRequest
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


    public function rules() : array
    {
        return [
          'id'                 => 'numeric',
          'email_proprietario' => 'required|email',
          'tipo_imovel'        => 'required|numeric',
          'cep'                => 'required|string|size:9',
          'endereco'           => 'required|string|min:2max:50',
          'numero'             => 'required|string|min:1,max:50',
          'bairro'             => 'required|string|min:2,max:50',
          'complemento'        => 'present',
          'estado'             => 'required|string|min:2,max:50',
          'cidade'             => 'required|string|max:50',
        ];
    }

    public function data(): PropriedadeDTO
    {
        return new PropriedadeDTO
                    ([
                         'id'                 => (int) $this->id,
                         'id_user'            => (int) auth()->id(),
                         'email_proprietario' => $this->email_proprietario,
                         'id_tipo'            => (int) $this->tipo_imovel,
                         'cep'                => $this->cep,
                         'endereco'           => $this->endereco,
                         'numero'             => $this->numero,
                         'bairro'             => $this->bairro,
                         'complemento'        => $this->complemento,
                         'estado'             => $this->estado,
                         'cidade'             => $this->cidade,
                    ]);
    }
}
