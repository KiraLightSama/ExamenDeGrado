@extends('layouts.app')
@section('link')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('alimento.edit') }}">Modificar Alimentos</a>
    </li>
@endsection
@section('content')
    <div class="container p-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if(!Session::has('success')) active @endif" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="@if(!Session::has('success')) true @else false @endif">Menu <b>{{ date('d-M') }}</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Session::has('success')) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="@if(Session::has('success')) true @else false @endif">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade @if(!Session::has('success')) active show @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-striped table-hover table-responsive-sm">
                    <thead>
                    <tr>
                        <th >ALIMENTO</th>
                        <th >CANTIDAD</th>
                        <th class="text-center">MARCAR</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tipo_alimento as $tipo)
                        <tr>
                            <th colspan="4">
                                <h4 class="text-center"><b>{{$tipo}}</b></h4>
                            </th>
                        </tr>
                        @foreach($menu_dia as $menu)
                            @if($tipo == $menu->tipo)
                                <tr>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter-{{$menu->id}}">
                                            <img src="{{ asset('foods/'.$menu->imagen) }}" alt="" width="50">
                                            {{ $menu->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $menu->cantidad }} - {{ $menu->medida }}</td>
                                    <td class="text-center">
                                        @if(!$menu->marcado)
                                            <form action="#" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $menu->id }}" name="alimento_id">
                                                <button class="btn btn-outline-success btn-sm" type="submit">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-outline-success btn-sm active">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @include('menu.modal')
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade @if(Session::has('success')) active show @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Grafico de seguimiento diario de peso</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seguimiento.create') }}" method="post" class="form-inline">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" name="peso" class="form-control" placeholder="Ingrese su peso en KG">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-save"></i></button>
                                    {{--<a class="btn btn-outline-success" href="{{route('download.seguimiento')}}"><i class="fa fa-download"></i></a>--}}
                                </div>
                            </div>
                        </form>
                        <div>
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('src/Chart.bundle.js') }}"></script>
    <script src="{{ asset('src/utils.js') }}"></script>
    <script>

        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach($seguimientos as $seguimiento)
                    , '{{date('d-M', strtotime($seguimiento->fecha))}}'
                    @endforeach
                ],
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Fechas'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Pesos'
                        }
                    }]
                }
            }
        };

        function cargarDatos() {
            var newDataset = {
                label: 'peso diario',
                backgroundColor: "#5bc0de",
                borderColor: "#5bc0de",
                data: [{{Auth::user()->peso}}],
                fill: false
            };

            @foreach($seguimientos as $seguimiento)
                newDataset.data.push({{$seguimiento->pivot->peso_actual}});
            @endforeach

            config.data.datasets.push(newDataset);
            window.myLine.update();
        }

        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
            config.data.datasets.splice(0, 1);
            config.data.datasets.splice(0, 2);
            cargarDatos();
            window.myLine.update();

        };
    </script>
@endsection