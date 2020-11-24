
@extends('layouts.app')
@section('content')
<div class="content">

    <div CLASS="row">

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ALIMENTO</th>
                <th scope="col">CANTIDAD</th>
                <th scope="col">UNIDAD MEDIDA	</th>
                <th scope="col">MARCAR</th>
            </tr>
            </thead>
            <tbody>

            @foreach($menu_dia as $menu)
            <tr>
                <th scope="row">{{ $menu->nombre }}</th>
                <td>{{ $menu->cantida }}</td>
                <td>{{ $menu->medida }}</td>
                <td>{{ $menu->marcado }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

<h1>estas en el listado de menu</h1>

@endsection