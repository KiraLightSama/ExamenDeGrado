<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Categoria;
use DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function desayuno($array)
    {
        $new_array = $array_bebida = $array_leche = $array_panes = array();
        foreach ($array as $key => $row) {
            if ($row['categoria_nombre'] == 'Bebidas') {
                array_push($array_bebida, [$row['id'], $row['calorias']]);
            }
            if ($row['categoria_nombre'] == 'Leches') {
                array_push($array_leche, [$row['id'], $row['calorias']]);
            }
            if ($row['categoria_nombre'] == 'Panes y otros') {
                array_push($array_panes, [$row['id'], $row['calorias']]);
            }
        }
        array_push($new_array, array_random($array_leche));
        array_push($new_array, array_random($array_panes));
        if ((bool)rand(0, 1)) {
            array_push($new_array, array_random($array_bebida));
        }
        return $new_array;
    }

    private function almuerzo($array)
    {
        $new_array = $array_carne = $array_tuberculo = $array_guarnicion = array();
        foreach ($array as $key => $row) {
            if ($row['categoria_nombre'] == 'Carnes') {
                array_push($array_carne, [$row['id'], $row['calorias']]);
            }
            if ($row['categoria_nombre'] == 'Guarnicion') {
                array_push($array_guarnicion, [$row['id'], $row['calorias']]);

            }
            if ($row['categoria_nombre'] == 'Tuberculos') {
                array_push($array_tuberculo, [$row['id'], $row['calorias']]);
            }
        }
        array_push($new_array, array_random($array_carne));
        array_push($new_array, array_random($array_tuberculo));
        if ((bool)rand(0, 1)) {
            array_push($new_array, array_random($array_guarnicion));
        } else {
            $dos_random = array_random($array_guarnicion, 2);
            array_push($new_array, ($dos_random[0]));
            array_push($new_array, ($dos_random[1]));
        }

        return $new_array;
    }

    private function cena($array)
    {
        $new_array = $array_carne = $array_tuberculo = $array_guarnicion = array();
        foreach ($array as $key => $row) {
            if ($row['categoria_nombre'] == 'Carnes') {
                array_push($array_carne, [$row['id'], $row['calorias']]);
            }
            if ($row['categoria_nombre'] == 'Guarnicion') {
                array_push($array_guarnicion, [$row['id'], $row['calorias']]);

            }
            if ($row['categoria_nombre'] == 'Tuberculos') {
                array_push($array_tuberculo, [$row['id'], $row['calorias']]);
            }
        }
        array_push($new_array, array_random($array_carne));
        array_push($new_array, array_random($array_tuberculo));
        if ((bool)rand(0, 1)) {
            array_push($new_array, array_random($array_guarnicion));
        } else {
            $dos_random = array_random($array_guarnicion, 2);
            array_push($new_array, ($dos_random[0]));
            array_push($new_array, ($dos_random[1]));
        }

        return $new_array;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->menus->count() > 0 && $user->menus()->orderByDesc('id')->first()->fecha == date('Y-m-d')) {
            $menu_dia=$user->menus()->join('alimentos','alimento_id', 'alimentos.id')
                ->select('alimentos.nombre','alimentos.cantidad','alimentos.medida','menus_users.marcado','menus_users.tipo')->get();
            $tipo_alimento;
            return view('menu.menu',compact('menu_dia'));

        } else {
            $menu = Menu::firstOrCreate(['fecha' => date('Y-m-d')]);

            /////////////////// DESAYUNO //////////////////////////
            $caloriaDesayuno = 0;
            while ($caloriaDesayuno < 4) {
                if ($caloriaDesayuno == 0) {
                    $alimento_asencial = $user->alimentos()
                        ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('distribucion', 'like', '%D%')
                        ->whereIn('categorias.nombre', ['Bebidas', 'Leches', 'Panes y otros'])
                        ->get()->toArray();

                    $desayuno_random = $this->desayuno($alimento_asencial);

                    foreach ($desayuno_random as $row) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Desayuno', 'marcado' => 0]);
                        $caloriaDesayuno++;
                    }
                } else {
                    $alimentoRandon = $user->alimentos()
                        ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('categorias.nombre', '=', 'Frutas')
                        ->get()->random();

                    $existe = $user->menus()
                        ->where('menus_users.alimento_id', '=', $alimentoRandon->id)
                        ->where('fecha', '=', date('Y-m-d'))
                        ->exists();

                    if (false == $existe) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Desayuno', 'marcado' => 0]);
                        $caloriaDesayuno++;
                    }
                }
            }
            /////////////////// FIN DESAYUNO //////////////////////////

            /////////////////// ALMUERZO //////////////////////////
            $caloriaAlmuerzo = 0;
            while ($caloriaAlmuerzo < rand(5, 6)) {
                if ($caloriaAlmuerzo == 0) {
                    $alimento_asencial = $user->alimentos()
                        ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('distribucion', 'like', '%A%')
                        ->whereIn('categorias.nombre', ['Carnes', 'Tuberculos', 'Guarnicion'])
                        ->get()->toArray();

                    $almuerzo_random = $this->almuerzo($alimento_asencial);

                    foreach ($almuerzo_random as $row) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Almuerzo', 'marcado' => 0]);
                        $caloriaAlmuerzo++;
                    }
                } else {
                    $alimentoRandon = $user->alimentos()
                        ->select('alimentos.*')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('categorias.nombre', '=', 'Frutas')
                        ->get()->random();

                    $existe = $user->menus()
                        ->where('menus_users.alimento_id', '=', $alimentoRandon->id)
                        ->where('fecha', '=', date('Y-m-d'))
                        ->exists();

                    if (false == $existe) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Almuerzo', 'marcado' => 0]);
                        $caloriaAlmuerzo++;
                    }
                }
            }
            ///////////////////  FIN DEL ALMUERZO //////////////////////////

            /////////////////// CENA //////////////////////////
            $caloriaCena = 0;
            while ($caloriaCena < rand(5, 6)) {
                if ($caloriaCena == 0) {

                    $a = array_column($user->menus()
                        ->select('menus_users.alimento_id')
                        ->where('fecha', '=', date('Y-m-d'))
                        ->get()
                        ->toArray(), 'alimento_id');

                    $alimento_asencial = $user->alimentos()
                        ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('distribucion', 'like', '%C%')
                        ->whereNotIn('alimento_id', $a)
                        ->get()->toArray();

                    $almuerzo_random = $this->cena($alimento_asencial);

                    foreach ($almuerzo_random as $row) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Cena', 'marcado' => 0]);
                        $caloriaCena++;
                    }
                } else {
                    $cenaRandon = $user->alimentos()
                        ->select('alimentos.*')
                        ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                        ->where('categorias.nombre', '=', 'Frutas')
                        ->get()
                        ->random();

                    $existe = $user->menus()
                        ->where('menus_users.alimento_id', '=', $cenaRandon->id)
                        ->where('fecha', '=', date('Y-m-d'))
                        ->exists();

                    if (false == $existe) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $cenaRandon->id, 'tipo' => 'Cena', 'marcado' => 0]);
                        $caloriaCena++;
                    }
                }
            }
            /////////////////// FIN CENA //////////////////////////

            switch ($user->cantidad_comidas) {
                case 4: {
                    $caloriaMM = 0;
                    while ($caloriaMM < rand(1, 2)) {
                        $alimento_asencial = $user->alimentos()
                            ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                            ->where('distribucion', 'like', '%MM%')
                            ->get()
                            ->random();

                        $existe = $user->menus()
                            ->where('menus_users.alimento_id', '=', $alimento_asencial->id)
                            ->where('fecha', '=', date('Y-m-d'))
                            ->exists();

                        if (false == $existe){
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media_M', 'marcado' => 0]);
                            $caloriaMM++;
                        }
                    }
                    break;
                }
                case 5: {
                    $caloriaMM = 0;
                    while ($caloriaMM < rand(1, 2)) {
                        $alimento_asencial = $user->alimentos()
                            ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                            ->where('distribucion', 'like', '%MM%')
                            ->get()
                            ->random();

                        $existe = $user->menus()
                            ->where('menus_users.alimento_id', '=', $alimento_asencial->id)
                            ->where('fecha', '=', date('Y-m-d'))
                            ->exists();

                        if (false == $existe){
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media_M', 'marcado' => 0]);
                            $caloriaMM++;
                        }
                    }

                    $caloriaMT = 0;
                    while ($caloriaMT < rand(1, 2)) {
                        $alimento_asencial = $user->alimentos()
                            ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                            ->where('distribucion', 'like', '%MT%')
                            ->get()
                            ->random();

                        $existe = $user->menus()
                            ->where('menus_users.alimento_id', '=', $alimento_asencial->id)
                            ->where('fecha', '=', date('Y-m-d'))
                            ->exists();

                        if (false == $existe){
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media_T', 'marcado' => 0]);
                            $caloriaMT++;
                        }
                    }
                    break;
                }
            }
        }
        return view('menu.menu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
