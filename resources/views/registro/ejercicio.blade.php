@extends('layouts.app')

@section('content')
    <div class="register-box" style="margin-top: 10px;">
        <div class="login-logo">
            <a class="" href="{{url('/')}}"><b>Nutri</b>SMART</a>
        </div>
        <div class="card elevation-4">
            <div class="card-header">
                <h3 class="py-2 login-box-msg"><b>Nivel de ejercicio</b></h3>
            </div>
            <div class="card-body register-card-body">
                <form action="{{ route('ejercicio.store') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="">
                        <input type="hidden" value="1" name="nivel">
                        <button type="submit" class="btn btn-block btn-outline-danger">
                            <div class="row">
                                <div class="col-3">
                                    <img class="rounded" width="70" src="{{asset('img/sedentario.png')}}"
                                         alt="algo">
                                </div>
                                <div class="col-9 py-3">
                                    <b>Sedentario</b> <br>
                                    <small>Nada o poco ejercicio</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="p-1"></div>
                <form action="{{ route('ejercicio.store') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <input type="hidden" value="2" name="nivel">
                        <button type="submit" class="btn btn-block btn-outline-warning">
                            <div class="row">
                                <div class="col-3">
                                    <img class="rounded" width="70" src="{{asset('img/ligero.png')}}"
                                         alt="algo">
                                </div>
                                <div class="col-9 py-3">
                                    <b>Ligero</b> <br>
                                    <small>Ejercicio 2-3 dias por semana</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="p-1"></div>
                <form action="{{ route('ejercicio.store') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <input type="hidden" value="3" name="nivel">
                        <button type="submit" class="btn btn-block btn-outline-info">
                            <div class="row">
                                <div class="col-3">
                                    <img class="rounded" width="70" src="{{asset('img/moderado.png')}}"
                                         alt="algo">
                                </div>
                                <div class="col-9 py-3">
                                    <b>Moderado</b> <br>
                                    <small>Ejercicio 4-5 dias por semana</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="p-1"></div>
                <form action="{{ route('ejercicio.store') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <input type="hidden" value="4" name="nivel">
                        <button type="submit" class="btn btn-block btn-outline-secondary">
                            <div class="row">
                                <div class="col-3">
                                    <img class="rounded" width="70" src="{{asset('img/alto.png')}}"
                                         alt="algo">
                                </div>
                                <div class="col-9 py-3">
                                    <b>Alto</b> <br>
                                    <small>Ejercicio 6-7 dias por semana</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="p-1"></div>
                <form action="{{ route('ejercicio.store') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <input type="hidden" value="5" name="nivel">
                        <button type="submit" class="btn btn-block btn-outline-success">
                            <div class="row">
                                <div class="col-3">
                                    <img class="rounded" width="70" src="{{asset('img/atleta.png')}}"
                                         alt="algo">
                                </div>
                                <div class="col-9 py-3">
                                    <b>Atleta profesional</b> <br>
                                    <small>Ejercicios intensos 6-7 dias por semana</small>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
