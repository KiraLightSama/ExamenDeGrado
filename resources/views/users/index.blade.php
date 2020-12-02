@extends('layouts.app')
@section('link')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('alimento.edit') }}">Modificar Alimentos</a>
    </li>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-auto">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Mensaje!</h5>
                        {!! Session::get('success') !!}
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item active">Perfil</li>
                    <li class="list-group-item"><b>Nombre: </b> {{ $user->nombre }}</li>
                    <li class="list-group-item"><b>Correo:</b> {{ $user->email }}</li>
                    <li class="list-group-item"><b>Genero:</b> {{ $user->genero }}</li>
                </ul>
                <ul class="list-group py-2">
                    <li class="list-group-item active">Metricas Corporales</li>
                    <li class="list-group-item"><b>Nacimiento:</b> {{ $user->fecha_nacimiento }}</li>
                    <li class="list-group-item"><b>Peso inicial:</b> {{ $user->peso }} Kg.</li>
                    <li class="list-group-item"><b>Estatura:</b> {{ $user->estatura }} cm.</li>
                </ul>
                <ul class="list-group py-2">
                    <li class="list-group-item active">Plan Nutricional</li>
                    <li class="list-group-item"><b>Cantidad de comidas:</b> {{ $user->cantidad_comidas }}</li>
                    <li class="list-group-item"><b>Calorias para mantener mi peso:</b> {{ $user->energia_actual }} Kcal.</li>
                    <li class="list-group-item"><b>Calorias Objetivo:</b> {{ $user->energia_objetivo }} Kcal.</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-auto">
                <ul class="list-group">
                    <li class="list-group-item active">Macronutrientes</li>
                    <li class="list-group-item"><b>Carbohidratos: </b>{{$user->carbohidratos}} Kcal.</li>
                    <li class="list-group-item"><b>Proteinas: </b>{{$user->proteina}} Kcal.</li>
                    <li class="list-group-item"><b>Grasas: </b>{{$user->grasa}} Kcal.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection