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

    private function almuerzo_cena($array)
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
            if (count($array_guarnicion) >= 2) {
                $dos_random = array_random($array_guarnicion, 2);
                array_push($new_array, ($dos_random[0]));
                array_push($new_array, ($dos_random[1]));
            } else {
                $dos_random = array_random($array_guarnicion, 1);
                array_push($new_array, ($dos_random[0]));
            }
        }
        return $new_array;
    }

    function obetnerCantidadComida($cantidad)
    {
        $cantidadComida = array();
        $cantidadComida = ['Desayuno', 'Media Mañana', 'Almuerzo', 'Media Tarde', 'Cena'];
        if ($cantidad == 3) {
            unset($cantidadComida[1], $cantidadComida[3]);
            return $cantidadComida;
            return $cantidadComida;
        }
        if ($cantidad == 4) {
            unset($cantidadComida[3]);
            return $cantidadComida;
        }
        if ($cantidad == 5) {
            return $cantidadComida;
        }

    }

    public function index()
    {
        $user = Auth::user();
        $tipo_alimento = $this->obetnerCantidadComida($user->cantidad_comidas);
        $seguimientos = $user->seguimientos()->get();

        if ($user->menus->count() > 0 && $user->menus()->orderByDesc('id')->first()->fecha == date('Y-m-d')) {
            $menu_dia = $user->menus()
                ->join('alimentos', 'alimento_id', 'alimentos.id')
                ->select('alimentos.id', 'alimentos.nombre', 'alimentos.imagen', 'alimentos.cantidad', 'alimentos.medida', 'menus_users.marcado', 'menus_users.tipo', 'alimentos.informacion', 'alimentos.carbohidratos', 'alimentos.proteinas', 'alimentos.grasas')
                ->where('fecha', date('Y-m-d'))
                ->get();

            return view('menu.menu', compact('menu_dia', 'tipo_alimento', 'seguimientos'));

        } else {
            $menu = Menu::firstOrCreate(['fecha' => date('Y-m-d')]);

            /////////////////// DESAYUNO //////////////////////////
            $caloriaDesayuno = 0;
            while ($caloriaDesayuno < rand(3, 4)) {
                $alimento_asencial = $user->alimentos()
                    ->select('alimentos.*')
                    ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
                    ->where('distribucion', 'like', '%D%')
                    ->get()->random();

                $existe = $this->existe($user, $alimento_asencial);

                if (false == $existe) {
                    $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Desayuno', 'marcado' => 0]);
                    $caloriaDesayuno++;
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
                        ->get()
                        ->toArray();

                    $almuerzo_random = $this->almuerzo_cena($alimento_asencial);

                    foreach ($almuerzo_random as $row) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Almuerzo', 'marcado' => 0]);
                        $caloriaAlmuerzo++;
                    }
                } else {
                    $alimentoRandon = $this->alimentoRandom($user);

                    $existe = $this->existe($user, $alimentoRandon);

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

                    $cena_random = $this->almuerzo_cena($alimento_asencial);

                    foreach ($cena_random as $row) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $row[0], 'tipo' => 'Cena', 'marcado' => 0]);
                        $caloriaCena++;
                    }
                } else {
                    $alimentoRandon = $this->alimentoRandom($user);

                    $existe = $this->existe($user, $alimentoRandon);

                    if (false == $existe) {
                        $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id, 'tipo' => 'Cena', 'marcado' => 0]);
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

                        $existe = $this->existe($user, $alimento_asencial);
                        if (false == $existe) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media Mañana', 'marcado' => 0]);
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

                        $existe = $this->existe($user, $alimento_asencial);

                        if (false == $existe) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media Mañana', 'marcado' => 0]);
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

                        $existe = $this->existe($user, $alimento_asencial);

                        if (false == $existe) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimento_asencial->id, 'tipo' => 'Media Tarde', 'marcado' => 0]);
                            $caloriaMT++;
                        }
                    }
                    break;
                }
            }
        }
        $menu_dia = $user->menus()
            ->join('alimentos', 'alimento_id', 'alimentos.id')
            ->select('alimentos.id', 'alimentos.nombre', 'alimentos.imagen', 'alimentos.cantidad', 'alimentos.medida', 'menus_users.marcado', 'menus_users.tipo', 'alimentos.informacion', 'alimentos.carbohidratos', 'alimentos.proteinas', 'alimentos.grasas')
            ->where('fecha', date('Y-m-d'))
            ->get();

        return view('menu.menu', compact('menu_dia', 'tipo_alimento', 'seguimientos'));
    }

    /**
     * @param $user
     * @param $alimentoRandon
     * @return mixed
     */
    private function existe($user, $alimentoRandon)
    {
        $existe = $user->menus()
            ->where('menus_users.alimento_id', '=', $alimentoRandon->id)
            ->where('fecha', '=', date('Y-m-d'))
            ->exists();
        return $existe;
    }

    /**
     * @param $user
     * @return mixed
     */
    private function alimentoRandom($user)
    {
        $alimentoRandon = $user->alimentos()
            ->select('alimentos.*')
            ->join('categorias', 'categorias.id', 'alimentos.categoria_id')
            ->where('categorias.nombre', '=', 'Frutas')
            ->get()
            ->random();
        return $alimentoRandon;
    }
}
