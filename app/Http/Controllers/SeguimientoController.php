<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuUser;
use App\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $seguimiento = Seguimiento::firstOrCreate(['fecha' => date('Y-m-d')]);

        $existe = $user->seguimientos()
            ->where('seguimientos_users.seguimiento_id', '=', $seguimiento->id)
            ->where('fecha', '=', date('Y-m-d'))
            ->exists();

        if (false == $existe) {
            $user->seguimientos()->attach($seguimiento->id, ['peso_actual' => $request->peso]);
        }

        return redirect()->route('menu.index')->withSuccess('active');
    }

    public function marcar (Request $request)
    {
        $user = Auth::user();

        $menu = Menu::where('fecha', date('Y-m-d'))->first();

        $menu_user = MenuUser::where('user_id', $user->id)
            ->where('alimento_id', $request->alimento_id)
            ->where('menu_id', $menu->id)
            ->first();

        $menu_user->marcado = 1;
        $menu_user->update();

        return redirect()->route('menu.index');
    }
}
