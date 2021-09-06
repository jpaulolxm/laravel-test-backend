<?php

namespace App\Http\Controllers;

use App\Actions\Contrato\CriarNovoContrato;
use App\Actions\Propriedade\CriarNovaPropriedade;
use App\Actions\Propriedade\UpdatePropriedade;
use App\Http\Requests\ContratoFormRequest;
use App\Http\Requests\PropriedadeFormRequest;
use App\Models\Contrato;
use App\Models\Propriedade;
use App\Models\TipoDePropriedadeEnum;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ContratoController extends Controller
{

    public function index(Request $request): Response
    {
        $search  = $request->get('search');
        $direcao = $request->get('direcao', 'desc');
        $orderBy = $request->get('orderBy', 'id');

        $query = Contrato::with(['propriedade', 'user'])->orderBy( $orderBy, $direcao );

        if($search)
        {
            $query->where('nome', 'LIKE', "%{$search}%");
            $query->orWhere('email',   'LIKE', "%{$search}%");
            $query->orWhere('documento',   'LIKE', "%{$search}%");
        }

        $props = ['search' => $search, 'direcao' => $direcao, 'orderBy' => $orderBy];

        return Inertia::render('Contrato/Index', array_merge(['contratos' => $query->paginate(8)->appends($props)], $props));
    }

    public function create(): Response
    {
        return Inertia::render('Contrato/NovoOuAtualizar');
    }

    public function store(ContratoFormRequest $request): RedirectResponse
    {

        CriarNovoContrato::create($request->data());

        return Redirect::route('contratos.index');

    }

    public function update(PropriedadeFormRequest $request): RedirectResponse
    {
        UpdatePropriedade::update($request->data());

        return Redirect::route('contratos.index');

    }

    public function delete(Contrato $contrato): RedirectResponse
    {
        $contrato->delete();

        return Redirect::back();

    }

}
