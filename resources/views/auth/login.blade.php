@extends('layouts.app')

@section('content')
    <div class="login-box" style="margin-top: 10px;">
        <div class="login-logo">
            <a class=" " href="{{url('/')}}"><b>Nutri</b>SMART</a>
        </div>
        <div class="card elevation-4  ">
            <div class="card-header">
                <p class="login-box-msg py-2  ">Iniciar session</p>
            </div>
            <div class="card-body login-card-body  ">

                <form action="{{route('login')}}" method="POST" aria-label="{{ __('Login') }}"
                      autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}    " name="email"
                               value="{{ old('email') }}" placeholder="Correo" autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="  fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}    "
                               name="password" autocomplete="off" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="  fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row py-2">
                        <div class="col-4 text-left">
                            <a href="{{ route('register') }}" class="btn btn-link" style="padding: 0;"><b class="">Registrar</b></a>
                        </div>
                        <div class="col-8 text-right">
                            <a href="{{route('password.request')}}" class="btn btn-link" style="padding: 0;"><b>Olvidaste tu contraseña?</b></a>
                        </div>
                    </div>
                    <div class="py-3">
                        <button type="submit" class="btn btn-outline-primary btn-block btn-flat">{{ __('Entrar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
