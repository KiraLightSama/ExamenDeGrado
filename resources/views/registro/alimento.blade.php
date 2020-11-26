@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <form action="{{ route('alimento.store') }}" method="POST" aria-label="alimentos" onsubmit="return validar()">
            @csrf


            {{--inicio javi---}}

                @foreach($clasificacion as $clasi)
                <div class="{{$clasi->nombre}}-container">
                <div class="title">
                        <p class="text-center   h3 p-2"><u>{{$clasi->nombre}}</u></p>
                    </div>

                    @foreach($alimentos as $alimento)
                        @if($clasi->id == $alimento->clasificacion_id)
                            <div class="{{$clasi->nombre}}-box bg-transparent">
                                <input class="food" type="checkbox" id="{{$alimento->id}}" name="{{$clasi->nombre}}[]"
                                       value="{{$alimento->id}}">
                                <label class="text-center" for="{{$alimento->id}}">
                                    <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                    {{$alimento->nombre}}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            <hr>
            {{--fin javi---}}
            {{---inicio sama--}}
            {{--
            <div class="title">
                <p class="text-center   h3 p-2"><u>Proteinass</u></p>
            </div>
            <div class="Proteinas-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Proteinass')
                        <div class="Proteinas-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="Proteinass[]"
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
                <p class="text-center   h3 p-2"><u>Carbohidratoss</u></p>
            </div>
            <div class="Carbohidratos-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Carbohidratoss')
                        <div class="Carbohidratos-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="Carbohidratoss[]"
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
            <div class="Grasas-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Grasas')
                        <div class="Grasas-box bg-transparent">
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
                <p class="text-center   h3 p-2"><u>Lacteoss y otros</u></p>
            </div>
            <div class="Lacteos-container">
                @foreach($alimentos as $alimento)
                    @if($alimento->nombre_clasi == 'Lacteoss y otros')
                        <div class="Lacteos-box bg-transparent">
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="Lacteoss[]"
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
                            <input class="food" type="checkbox" id="{{$alimento->id}}" name="Frutas[]"
                                   value="{{$alimento->id}}">
                            <label class="text-center" for="{{$alimento->id}}">
                                <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                {{$alimento->nombre_alimento}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            --}}
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

        var Proteinas = new Waterfall({
            containerSelector: '.Proteinas-container',
            boxSelector: '.Proteinas-box',
            minBoxWidth: 110
        });

        var Carbohidratos = new Waterfall({
            containerSelector: '.Carbohidratos-container',
            boxSelector: '.Carbohidratos-box',
            minBoxWidth: 110
        });

        var grasa = new Waterfall({
            containerSelector: '.Grasas-container',
            boxSelector: '.Grasas-box',
            minBoxWidth: 110
        });

        var Lacteos = new Waterfall({
            containerSelector: '.Lacteos-container',
            boxSelector: '.Lacteos-box',
            minBoxWidth: 110
        });

        var Frutas = new Waterfall({
            containerSelector: '.Frutas-container',
            boxSelector: '.Frutas-box',
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
                nombre: 'Frutas',
                requerido: 6
            },
            {
                nombre: 'Lacteos',
                requerido: 2
            },
            {
                nombre: 'Grasas',
                requerido: 3
            },
            {
                nombre: 'Carbohidratos',
                requerido: 8
            },
            {
                nombre: 'Proteinas',
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