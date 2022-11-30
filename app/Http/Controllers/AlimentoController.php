<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Categoria;
use Categorias;
use Illuminate\Http\Request;

/**
 * Class AlimentoController
 * @package App\Http\Controllers
 */
class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alimentos = Alimento::paginate();
        
        $categorias2 = Categoria::all();

        foreach ( $alimentos as $alimento){
            foreach($categorias2 as $categoria){
                if ($alimento['categoria_id']==$categoria->id){
                    $alimento['categoria']=$categoria['nombre'];
                }
            }
        }
        return view('alimento.index', compact('alimentos'))
            ->with('i', (request()->input('page', 1) - 1) * $alimentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alimento = new Alimento();
        $categorias= Categoria::pluck('nombre', 'id');
        return view('alimento.create', compact('alimento','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Alimento::$rules);

        $alimento = Alimento::create($request->all());

        return redirect()->route('alimentos.index')
            ->with('success', 'Alimento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alimento = Alimento::find($id);

        return view('alimento.show', compact('alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alimento = Alimento::find($id);
        $categorias= Categoria::pluck('nombre', 'id');

        return view('alimento.edit', compact('alimento','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Alimento $alimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alimento $alimento)
    {
        request()->validate(Alimento::$rules);

        $alimento->update($request->all());

        return redirect()->route('alimentos.index')
            ->with('success', 'Alimento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $alimento = Alimento::find($id)->delete();

        return redirect()->route('alimentos.index')
            ->with('success', 'Alimento deleted successfully');
    }
}
