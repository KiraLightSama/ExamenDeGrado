@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <form action="{{ route('alimento.store') }}" method="POST" aria-label="alimentos" onsubmit="return validar()">
            @csrf
            <div class="title">
                <p class="text-center   h3 p-2"><u>Proteinas</u></p>
            </div>
            <div class="proteina-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Proteinas')
                        <div class="proteina-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="proteinas[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="title">
                <p class="text-center   h3 p-2"><u>Carbohidratos</u></p>
            </div>
            <div class="carbohidrato-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Carbohidratos')
                        <div class="carbohidrato-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="carbohidratos[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="title">
                <p class="text-center   h3 p-2"><u>Grasas</u></p>
            </div>
            <div class="grasa-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Grasas')
                        <div class="grasa-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="grasas[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="title">
                <p class="text-center   h3 p-2"><u>Lacteos y otros</u></p>
            </div>
            <div class="lacteo-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Lacteos y otros')
                        <div class="lacteo-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="lacteos[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="title">
                <p class="text-center   h3 p-2"><u>Frutas</u></p>
            </div>
            <div class="fruta-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Frutas')
                        <div class="fruta-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="frutas[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="d-block d-sm-none p-3">
                <button type="button" class="btn btn-outline-primary btn-block btn-flat" data-toggle="modal"
                        data-target="#modal-cantidad-alimento">Guardar
                </button>
            </div>

            <div class="d-none d-sm-block p-3">
                <button type="button" class="btn btn-outline-primary btn-flat" data-toggle="modal"
                        data-target="#modal-cantidad-alimento">Guardar
                </button>
            </div>
            <div class="modal fade" id="modal-cantidad-alimento">
                <div class="modal-dialog">
                    <div class="modal-content bg-default">
                        <div class="modal-header">
                            <h4 class="modal-title">Cantidad de alimentos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cantidad">¿Cuantos alimentos consumes al dia?</label>
                                <select name="cantidad" id="cantidad" class="form-control">
                                    <option value="3">3 comidas al dia</option>
                                    <option value="4">4 comidas al dia</option>
                                    <option value="5">5 comidas al dia</option>
                                </select>
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
@endsection
@section('scripts')
    <script>

        var proteina = new Waterfall({
            containerSelector: '.proteina-container',
            boxSelector: '.proteina-box',
            minBoxWidth: 110
        });

        var carbohidrato = new Waterfall({
            containerSelector: '.carbohidrato-container',
            boxSelector: '.carbohidrato-box',
            minBoxWidth: 110
        });

        var grasa = new Waterfall({
            containerSelector: '.grasa-container',
            boxSelector: '.grasa-box',
            minBoxWidth: 110
        });

        var lacteo = new Waterfall({
            containerSelector: '.lacteo-container',
            boxSelector: '.lacteo-box',
            minBoxWidth: 110
        });

        var fruta = new Waterfall({
            containerSelector: '.fruta-container',
            boxSelector: '.fruta-box',
            minBoxWidth: 110
        });

        $('.food').change(function (event) {
            var nuevo, borrar, clase, newclass;
            var check = event.target;
            if (check.checked) {
                clase = this.parentNode.className;
                borrar = "bg-transparent";
                nuevo = "cambio";
                newclass = clase.replace(borrar, nuevo);
                this.parentNode.className = newclass;
            } else {
                clase = this.parentNode.className;
                borrar = "cambio";
                nuevo = "bg-transparent";
                newclass = clase.replace(borrar, nuevo);
                this.parentNode.className = newclass;
            }
        });

        function validar() {
            var validaciones = tipos.map(function (tipo) {
                return validate(tipo.nombre, tipo.requerido);
            });

            return !validaciones.includes(false);
        }

        var tipos = [
            {
                nombre: 'frutas',
                requerido: 3
            },
            {
                nombre: 'lacteos',
                requerido: 2
            },
            {
                nombre: 'grasas',
                requerido: 3
            },
            {
                nombre: 'carbohidratos',
                requerido: 8
            },
            {
                nombre: 'proteinas',
                requerido: 4
            }
        ];

        function validate(nombre, requerido) {
            var contador = 0;
            $('[name = "' + nombre + '[]"]:checked').each(function () {
                contador++;
            });

            if (contador < requerido) {
                toastr.options = {
                    progressBar: true,
                    preventDuplicates: true,
                    newestOnTop: true,
                    showDuration: 500,
                    hideDuration: 2000,
                    extendedTimeOut: 2000
                };

                toastr.error("Debe seleccionar al menos " + requerido + " fuentes de " + nombre, nombre);
                return false;
            }
        }
    </script>
@endsection