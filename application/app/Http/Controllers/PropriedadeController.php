<?php

namespace App\Http\Controllers;

use App\Actions\Propriedade\CriarNovaPropriedade;
use App\Actions\Propriedade\UpdatePropriedade;
use App\Http\Requests\PropriedadeFormRequest;
use App\Models\Propriedade;
use App\Models\StatusPropriedadeEnum;
use App\Models\TipoDePropriedadeEnum;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PropriedadeController extends Controller
{

    public function index(Request $request): Response
    {
        $search  = $request->get('search');
        $direcao = $request->get('direcao', 'desc');
        $orderBy = $request->get('orderBy', 'id');

        $query = Propriedade::with(['user'])->orderBy( $orderBy, $direcao );

        if($search)
        {
            $query->orWhere('email_proprietario', 'LIKE', "%{$search}%");
            $query->orWhere('bairro',   'LIKE', "%{$search}%");
            $query->orWhere('endereco', 'LIKE', "%{$search}%");
            $query->orWhere('cidade',   'LIKE', "%{$search}%");
        }

        $props = ['search' => $search, 'direcao' => $direcao, 'orderBy' => $orderBy];

        return Inertia::render('Propriedade/Index', array_merge(['propriedades' => $query->paginate(8)->appends($props)], $props));
    }

    public function search(Request $request)
    {
        $search  = $request->get('search');

        $query = Propriedade::orderBy( 'id', 'desc' );

        $query->where('id_status', '=', StatusPropriedadeEnum::NAO_CONTRADO );

        if($search)
        {
            $query->where('endereco', 'LIKE', "%{$search}%");
            $query->orwhere('email_proprietario', 'LIKE', "%{$search}%");
            $query->orWhere('bairro',   'LIKE', "%{$search}%");
            $query->orWhere('cidade',   'LIKE', "%{$search}%");
        }



        return $query->paginate(8);
    }



    public function create(): array
    {
        return ['tipos'  => TipoDePropriedadeEnum::map(),'type' => 'CREATE'];
    }

    public function store(PropriedadeFormRequest $request): RedirectResponse
    {

        CriarNovaPropriedade::create($request->data());

        return Redirect::route('propriedades.index');

    }

    public function update(PropriedadeFormRequest $request): RedirectResponse
    {
        UpdatePropriedade::update($request->data());

        return Redirect::route('propriedades.index');

    }

    public function delete(Propriedade $propriedade): RedirectResponse
    {
        $propriedade->delete();

        return Redirect::back();

    }

}
