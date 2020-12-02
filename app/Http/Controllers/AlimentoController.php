<?php

namespace App\Http\Controllers;

use App\AlimentoUser;
use App\Clasificacion;
use Illuminate\Http\Request;
use App\Alimento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Menu;

class AlimentoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alimentos = Alimento::all();
        $clasificacion = Clasificacion::all();

        return view('registro.alimento', compact('alimentos', 'clasificacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->alimentos()->sync(array_merge($request->Grasas, $request->Proteinas, $request->Carbohidratos, $request->Lacteos, $request->Frutas));
        $user->cantidad_comidas = $request->cantidad;
        $user->update();
        DB::table('menus_users')->where('user_id', $user->id)->delete(); /*borra datos */

        //$user->menus()->detach(75);
        //$user->menus()->detach(Menu::where('fecha', '=', date('Y-m-d'))->select('id')->first()->toArray());

        return redirect()->route('menu.index');
    }

    private function tieneListaPreferencias()
    {
        $user = Auth::user();

        return !is_null(AlimentoUser::join('users', 'alimentos_users.user_id', 'users.id')
            ->where('users.id', $user->id)
            ->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $alimentos = Alimento::all();
        $clasificacion = Clasificacion::all();
        $alimento_user = Auth::user()->alimentos()->select('alimentos.id as id')->get();

        return view('registro.editAlimento', compact('alimentos', 'clasificacion', 'alimento_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->alimentos()->sync(array_merge($request->Grasas, $request->Proteinas, $request->Carbohidratos, $request->Lacteos, $request->Frutas));

        DB::table('menus_users')->where('user_id', $user->id)->delete(); /*borra datos */

        //$user->menus()->detach(75);
        //$user->menus()->detach(Menu::where('fecha', '=', date('Y-m-d'))->select('id')->first()->toArray());

        return redirect()->route('menu.index');
    }
}
