@extends('layouts.app')

@section('content')
    <div class="register-box" style="margin-top: 10px;">
        <div class="login-logo">
            <a class=" " href="{{url('/')}}"><b>Nutri</b>SMART</a>
        </div>
        <div class="card elevation-4  ">
            <div class="card-header">
                <h3 class="  py-2 login-box-msg"><b>Objetivo</b></h3>
            </div>
            <div class="card-body register-card-body  ">
                <form action="{{ route('objetivo.bajar') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                data-target="#modal-bajar">
                            <img class="rounded" width="100" src="{{asset('img/bajar.png')}}"
                                 alt="algo">
                            Reducir Grasa
                        </button>
                    </div>
                    <div class="modal fade" id="modal-bajar">
                        <div class="modal-dialog">
                            <div class="modal-content bg-default">
                                <div class="modal-header">
                                    <h4 class="modal-title">Reducir Grasa</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Como quieres alcanzar tu objetivo?</p>
                                    <div class="slider-green p-5">
                                        <input id="bajar" type="text" name="bajar" value="">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                        Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </form>
                <div class="p-1"></div>
                <form action="{{ route('objetivo.mantener') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <input type="hidden" value="6" name="mantener">
                        <button type="submit" class="btn btn-block btn-outline-warning">
                            <img class="rounded" width="100" src="{{asset('img/mantener.png')}}"
                                 alt="algo">
                            Mantener peso
                        </button>
                    </div>
                </form>
                <div class="p-1"></div>
                <form action="{{ route('objetivo.subir') }}" method="POST" aria-label="Objetivo" autocomplete="off">
                    @csrf
                    <div class="text-center">
                        <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal"
                                data-target="#modal-musculo">
                            <img class="rounded" width="100" src="{{asset('img/musculo.png')}}"
                                 alt="algo">
                            Construir musculo
                        </button>
                    </div>
                    <div class="modal fade" id="modal-musculo">
                        <div class="modal-dialog">
                            <div class="modal-content bg-default">
                                <div class="modal-header">
                                    <h4 class="modal-title">Construir musculo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Como quieres alcanzar tu objetivo?</p>
                                    <div class="slider-green p-5">
                                        <input id="musculo" type="text" name="musculo" value="">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                        Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </form>
            </div>
        </div>
    </div>
@endsection
