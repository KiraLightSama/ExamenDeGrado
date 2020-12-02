@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <form action="{{ route('alimento.update') }}" method="POST" aria-label="alimentos" onsubmit="return validar()">
            @csrf
            @foreach($clasificacion as $clasi)
                <div class="{{$clasi->nombre}}-container">
                    <div class="title">
                        <p class="text-center   h3 p-2"><u>{{$clasi->nombre}}</u></p>
                    </div>

                    @foreach($alimentos as $alimento)
                        @if($clasi->id == $alimento->clasificacion_id)
                            @if(in_array($alimento->id, $alimento_user->pluck('id', 'id')->toArray(), true))
                            <div class="{{$clasi->nombre}}-box cambio">
                                <input class="food" type="checkbox" id="{{$alimento->id}}" name="{{$clasi->nombre}}[]"
                                       value="{{$alimento->id}}" checked>
                                <label class="text-center" for="{{$alimento->id}}">
                                    <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                    {{$alimento->nombre}}
                                </label>
                            </div>
                            @else
                                <div class="{{$clasi->nombre}}-box bg-transparent">
                                    <input class="food" type="checkbox" id="{{$alimento->id}}" name="{{$clasi->nombre}}[]"
                                           value="{{$alimento->id}}">
                                    <label class="text-center" for="{{$alimento->id}}">
                                        <img src="{{asset('foods/'.$alimento->imagen)}}" alt="" width="100%">
                                        {{$alimento->nombre}}
                                    </label>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            @endforeach
            <div class="d-block d-sm-none p-3">
                <button type="submit" class="btn btn-outline-primary btn-block btn-flat">Guardar
                </button>
            </div>

            <div class="d-none d-sm-block p-3">
                <button type="submit" class="btn btn-outline-primary btn-flat">Guardar
                </button>
            </div>
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

        var Grasas = new Waterfall({
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