<?php

namespace App\Http\Controllers;

use App\Actions\Relatorio\CriarRelatorio;
use App\Http\Requests\RelatorioFormRequest;
use App\Models\Relatorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RelatorioController extends Controller
{
  public function index(): Response
  {
    return Inertia::render('Relatorio/Index',
        [
            'relatorios'   => Relatorio::orderBy('id', 'desc')->limit(10)->get(),
            'dataInicial' => date('Y-m-d'),
            'dataFinal'   => date('Y-m-d'),
        ]);
  }

  public function create(RelatorioFormRequest $request): RedirectResponse
  {

      (new CriarRelatorio)->create($request->data());

      return Redirect::route('relatorio.index');
  }

    public function download(Relatorio $relatorio): StreamedResponse
    {
        return Storage::download($relatorio->path);
    }
}
