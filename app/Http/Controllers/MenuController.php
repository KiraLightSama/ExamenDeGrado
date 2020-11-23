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
    public function index()
    {
      /*  $ali=Auth::user()->menus() ->select('alimentos.*')
            ->join('alimentos','alimentos.id','menus_users.alimento_id')
            ->join('categorias','categorias.id','alimentos.categoria_id')
            ->where('categorias.nombre','=','Carnes')
            ->get()->random(2);

        dd($ali);
*/

        $carne=$guarnicion= $tuberculos= Auth::user()->alimentos()
            ->select('alimentos.*')
            ->join('categorias','categorias.id','alimentos.categoria_id')
            ->where('distribucion','like','%A%')
            ->where('categorias.nombre','=','Carnes')->get()->random();

        dd($carne);

        $user=Auth::user();

        if ($user->menus->count()>0 && $user->menus()->orderByDesc('id')->first()->fecha == date('Y-m-d')){
            dd('MOSTRAR MENU');
        }else{
            //crear menu
          $menu =  Menu::create(['fecha'=> date('Y-m-d')]);
            $preferenciasAlimentarias=$user->alimentos;
            switch (Auth::user()->cantidad_comidas) {
                case 3: {
                    $energiaD = (int)($user->energia_objetivo / 3) - rand(0, 50);
                    $energiaC = (int)($user->energia_objetivo / 3) - rand(0, 50);
                    $energiaA = $user->energia_objetivo - ($energiaD + $energiaC);
                    $caloriaDesayuno=0;
                    $caloriaAlmuerzo=0;
                    $caloriaCena=0;

                    /////////////////// DESAYUNO //////////////////////////

                    while ($caloriaDesayuno<=$energiaD){
                        $alimentoRandon= $user->alimentos()
                            ->select('alimentos.*')
                            ->join('categorias','categorias.id','alimentos.categoria_id')
                            ->where('distribucion','like','%D%')->get()->random();
                        if (false==$user->menus()->where('menus_users.alimento_id','=',$alimentoRandon->id)
                                        ->where('fecha','=',date('Y-m-d'))->exists()
                                       ) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id , 'tipo'=>'Desayuno','marcado'=>0]);
                            $caloriaDesayuno=$caloriaDesayuno+$alimentoRandon->calorias;
                        }

                    }

                    /////////////////// FIN DESAYUNO //////////////////////////

                    /////////////////// ALMUERZO //////////////////////////

                    while ($caloriaAlmuerzo<=$energiaA){

                        if($caloriaAlmuerzo==0){

                            DB::table('view_alimentoUser')
                                ->where('categoria_nombre','=','Carnes')
                                ->where('user_id','=',$user->id)
                                ->get()->random();



                        }
                        else{

                            $alimentoRandon= $user->alimentos()
                                ->select('alimentos.*')
                                ->join('categorias','categorias.id','alimentos.categoria_id')
                                ->where('categorias.nombres','=','Frutas')
                                ->get()->random();
                            $existe= $user->menus()->where('menus_users.alimento_id','=',$alimentoRandon->id)
                                ->where('fecha','=',date('Y-m-d'))->exists();

                            if (false==$existe ) {
                                $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id , 'tipo'=>'Almuerzo','marcado'=>0]);
                                $caloriaAlmuerzo=$caloriaAlmuerzo+$alimentoRandon->calorias;
                            }
                        }


                    }

                    ///////////////////  FIN DEL ALMUERZO //////////////////////////


                    while ($caloriaCena<=$energiaC){
                        $alimentoRandon= $user->alimentos()
                            ->select('alimentos.*')
                            ->join('categorias','categorias.id','alimentos.categoria_id')
                            ->where('distribucion','like','%C%')->get()->random();
                        if (false==$user->menus()->where('menus_users.alimento_id','=',$alimentoRandon->id)
                                        ->where('fecha','=',date('Y-m-d'))->exists()
                                       ) {
                            $user->menus()->attach($menu->id, ['alimento_id' => $alimentoRandon->id , 'tipo'=>'Cena','marcado'=>0]);
                            $caloriaCena=$caloriaCena+$alimentoRandon->calorias;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
