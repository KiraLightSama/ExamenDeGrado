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


    public function almuerzo($array){
        $new_array= $array_carne= $array_tuberculo= $array_guarnicion=array();
        foreach ($array as  $key =>$row){
            if ($row['categoria_nombre'] == 'Carnes')
            {
                array_push($array_carne,[$row['id'],$row['calorias']]);
            }
            if ($row['categoria_nombre'] == 'Guarnicion'){
                array_push($array_guarnicion,[$row['id'],$row['calorias']]);

            }
            if ($row['categoria_nombre'] == 'Tuberculos'){
                array_push($array_tuberculo,[$row['id'],$row['calorias']]);

            }
        }
        array_push($new_array,array_random($array_carne));
        array_push($new_array,array_random($array_tuberculo));
        if ((bool)rand(0,1)){
            array_push($new_array,array_random($array_guarnicion));
        }else{
           $dos_random= array_random($array_guarnicion,2);
            array_push($new_array,($dos_random[0]));
            array_push($new_array,($dos_random[1]));
        }

        return $new_array;
    }

    public function index()
    {
       /* $a = Auth::user()->alimentos()
            ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
            ->where('distribucion', 'like', '%A%')
            ->whereIn('categorias.nombre', ['Carnes', 'Tuberculos', 'Guarnicion'])->get()->toArray();

        dd(($this->almuerzo($a)));
        $b = array_column($a, 'categoria_nombre', 'id');

        dd($this->buscarAlimentoRandon($b,'Carnes'));

        $carne = $guarnicion = $tuberculos = Auth::user()->alimentos()
            ->select('alimentos.*')
            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
            ->where('distribucion', 'like', '%A%')
            ->where('categorias.nombre', '=', 'Carnes')->get()->random();

*/

        $user = Auth::user();

        if ($user->menus->count() > 0 && $user->menus()->orderByDesc('id')->first()->fecha == date('Y-m-d')) {
            dd('MOSTRAR MENU');
        } else {
            //crear menu
            $menu = Menu::create(['fecha' => date('Y-m-d')]);
            $preferenciasAlimentarias = $user->alimentos;
            switch (Auth::user()->cantidad_comidas) {
                case 3: {
                    $energiaD = (int)($user->energia_objetivo / 3) - rand(0, 50);
                    $energiaC = (int)($user->energia_objetivo / 3) - rand(0, 50);
                    $energiaA = $user->energia_objetivo - ($energiaD + $energiaC);
                    $caloriaDesayuno = 0;
                    $caloriaAlmuerzo = 0;
                    $caloriaCena = 0;

                    /////////////////// DESAYUNO //////////////////////////

                    while ($caloriaDesayuno <= $energiaD) {
                        $alimentoRandon = $user->alimentos()
                            ->select('alimentos.*')
                            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                            ->where('distribucion', 'like', '%D%')->get()->random();
                        if (false == $user->menus()->where('menus_users.alimento_id', '=', $alimentoRandon->id)
                                ->where('fecha', '=', date('Y-m-d'))->exists()
                        ) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Desayuno', 'marcado' => 0]);
                            $caloriaDesayuno = $caloriaDesayuno + $alimentoRandon->calorias;
                        }

                    }

                    /////////////////// FIN DESAYUNO //////////////////////////

                    /////////////////// ALMUERZO //////////////////////////

                    while ($caloriaAlmuerzo <= $energiaA) {

                        if ($caloriaAlmuerzo == 0) {

                           $alimento_asencial= Auth::user()->alimentos()
                                ->select('alimentos.*', 'categorias.nombre as categoria_nombre')
                                ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                                ->where('distribucion', 'like', '%A%')
                                ->whereIn('categorias.nombre', ['Carnes', 'Tuberculos', 'Guarnicion'])->get()->toArray();
                            $almuerzo_random=$this->almuerzo($alimento_asencial);

                           foreach ($almuerzo_random as $row){
                               $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Almuerzo', 'marcado' => 0]);
                               $caloriaAlmuerzo=$caloriaAlmuerzo+$row[1];
                           }

                        } else {

                            $alimentoRandon = $user->alimentos()
                                ->select('alimentos.*')
                                ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                                ->where('categorias.nombre', '=', 'Frutas')
                                ->get()->random();
                            $existe = $user->menus()->where('menus_users.alimento_id', '=', $alimentoRandon->id)
                                ->where('fecha', '=', date('Y-m-d'))->exists();

                            if (false == $existe) {
                                $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Almuerzo', 'marcado' => 0]);
                                $caloriaAlmuerzo = $caloriaAlmuerzo + $alimentoRandon->calorias;
                            }
                        }


                    }

                    ///////////////////  FIN DEL ALMUERZO //////////////////////////


                    while ($caloriaCena <= $energiaC) {
                        $alimentoRandon = $user->alimentos()
                            ->select('alimentos.*')
                            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                            ->where('distribucion', 'like', '%C%')->get()->random();
                        if (false == $user->menus()->where('menus_users.alimento_id', '=', $alimentoRandon->id)
                                ->where('fecha', '=', date('Y-m-d'))->exists()
                        ) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Cena', 'marcado' => 0]);
                            $caloriaCena = $caloriaCena + $alimentoRandon->calorias;
                        }

                    }


                }

            }

        }
        return view('menu.menu');
    }


    private function getEnergiaAlimento($alimento)
    {
        return ($alimento->cantidad * $alimento->calorias) / 100;
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
