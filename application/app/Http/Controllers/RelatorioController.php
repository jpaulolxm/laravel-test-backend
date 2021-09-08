<?php

namespace App\Http\Controllers;

use App\Actions\Relatorio\CriarRelatorio;
use App\Http\Requests\RelatorioFormRequest;
use App\Models\Relatorio;
use App\Models\StatusRelatorioEnum;
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
        $relatorios = Relatorio::with(['user'])->orderBy('id', 'desc')->limit(10)->get();

        return Inertia::render('Relatorio/Index',
                [
                    'relatorios'   => $relatorios,
                    'dataInicial' => date('Y-m-d'),
                    'dataFinal'   => date('Y-m-d'),
                    'isProcess'   => (bool) $relatorios->where('id_status', StatusRelatorioEnum::PROCESSANDO)->first(),
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
