<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Objetivo;
use App\Ejercicio;

class ObjetivoController extends Controller
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
        return view('registro.objetivo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bajar(Request $request)
    {
        $user = Auth::user();
        $user->objetivo_id = $request->bajar;
        $user->update();

        $objetivo = Objetivo::findOrFail($user->objetivo_id);
        $ejercicio = Ejercicio::findOrFail($user->ejercicio_id);

        $peso = $user->peso;
        $estatura = $user->estatura;
        $edad = $user->fecha_nacimiento;
        $genero = $user->genero;
        $nivelejercicio = $ejercicio->valor;

        /**
         * calculo del gasto calorico y el objetivo energetico
         */
        $energia = round($this->caloria($peso, $estatura, $edad, $nivelejercicio, $genero), 0, PHP_ROUND_HALF_EVEN);
        $deficit = round($energia - ($energia * ($objetivo->valor / 100)), 0, PHP_ROUND_HALF_EVEN);

        $user->energia_actual = $energia;
        $user->energia_objetivo = $deficit;

        /**
         * calculo de los macronutrientes
         */
        $user->proteina = $deficit * 0.4;
        $user->grasa = $deficit * 0.2;
        $user->carbohidratos = $deficit * 0.4;

        $user->update();

        return redirect()->route('preferencia.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mantener(Request $request)
    {
        $user = Auth::user();
        $user->objetivo_id = $request->mantener;
        $user->update();

        $ejercicio = Ejercicio::findOrFail($user->ejercicio_id);
        $objetivo = Objetivo::findOrFail($user->objetivo_id);

        $peso = $user->peso;
        $estatura = $user->estatura;
        $edad = $user->fecha_nacimiento;
        $genero = $user->genero;
        $nivelejercicio = $ejercicio->valor;

        /**
         * calculo del gasto calorico y el objetivo energetico
         */
        $energia = round($this->caloria($peso, $estatura, $edad, $nivelejercicio, $genero), 0, PHP_ROUND_HALF_EVEN);

        $user->energia_actual = $energia;
        $user->energia_objetivo = $energia;

        /**
         * calculo de los macronutrientes
         */
        $user->proteina = $energia * 0.35;
        $user->grasa = $energia * 0.25;
        $user->carbohidratos = $energia * 0.4;

        $user->update();

        return redirect()->route('preferencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function subir(Request $request)
    {
        $user = Auth::user();
        $user->objetivo_id = $request->musculo;
        $user->update();

        $objetivo = Objetivo::findOrFail($user->objetivo_id);
        $ejercicio = Ejercicio::findOrFail($user->ejercicio_id);

        $peso = $user->peso;
        $estatura = $user->estatura;
        $edad = $user->fecha_nacimiento;
        $genero = $user->genero;
        $nivelejercicio = $ejercicio->valor;

        /**
         * calculo del gasto calorico y el objetivo energetico
         */
        $energia = round($this->caloria($peso, $estatura, $edad, $nivelejercicio, $genero), 0, PHP_ROUND_HALF_EVEN);
        $superavit = round($energia + ($energia * ($objetivo->valor / 100)), 0, PHP_ROUND_HALF_EVEN);

        $user->energia_actual = $energia;
        $user->energia_objetivo = $superavit;

        /**
         * calculo de los macronutrientes
         */
        $user->proteina = $superavit * 0.3;
        $user->grasa = $superavit * 0.2;
        $user->carbohidratos = $superavit * 0.5;

        $user->update();

        return redirect()->route('preferencia.create');
    }

    private function edad($nacimiento)
    {
        $diferencia = abs(strtotime(date('Y-m-d')) - strtotime($nacimiento));
        return floor($diferencia / (60 * 60 * 24 * 365));
    }

    private function caloria($peso, $estatura, $edad, $ejercicio, $sexo)
    {
        switch ($sexo) {
            case 'H':
                return ((66 + (13.751 * $peso) + (5.0033 * $estatura) - (6.7550 * $this->edad($edad))) * $ejercicio);
                break;
            case 'M':
                return (665.1 + (9.463 * $peso) + (1.8 * $estatura) - (4.6756 * $this->edad($edad))) * $ejercicio;
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
