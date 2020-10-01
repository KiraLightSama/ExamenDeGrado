<?php

namespace App\Http\Controllers;

use App\AlimentoUser;
use Illuminate\Http\Request;
use App\Alimento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alimentos = Alimento::join('clasificaciones', 'alimentos.clasificacion_id', 'clasificaciones.id')
            ->select('alimentos.id',
                'alimentos.nombre as nombre_alimento',
                'alimentos.imagen',
                'clasificaciones.nombre as nombre_clasi')
            ->orderBy('nombre_alimento', 'ASC')
            ->get();

        return view('registro.alimento', compact('alimentos'));
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

        if (!$this->tieneListaPreferencias()) {
            foreach ($request->proteinas as $proteina) {
                DB::table('alimentos_users')->insert(
                    ['user_id' => $user->id, 'alimento_id' => $proteina]
                );
            }

            foreach ($request->carbohidratos as $carbohidrato) {
                DB::table('alimentos_users')->insert(
                    ['user_id' => $user->id, 'alimento_id' => $carbohidrato]
                );
            }

            foreach ($request->grasas as $grasa) {
                DB::table('alimentos_users')->insert(
                    ['user_id' => $user->id, 'alimento_id' => $grasa]
                );
            }

            foreach ($request->lacteos as $lacteo) {
                DB::table('alimentos_users')->insert(
                    ['user_id' => $user->id, 'alimento_id' => $lacteo]
                );
            }

            foreach ($request->frutas as $fruta) {
                DB::table('alimentos_users')->insert(
                    ['user_id' => $user->id, 'alimento_id' => $fruta]
                );
            }

            $user->cantidad_comidas = $request->cantidad;
            $user->update();
        }

        return redirect()->route('seguimiento.create');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
