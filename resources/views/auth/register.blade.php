@extends('layouts.app')

@section('content')
    <div class="register-box  " style="margin-top: 10px;">
        <div class="login-logo">
            <a class="   " href="{{url('/')}}"><b>Nutri</b>SMART</a>
        </div>
        <div class="card elevation-4  ">
            <div class="card-header">
                <p class="register-box-msg py-2">Registrarse</p>
            </div>
            <div class="card-body register-card-body  ">
                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"
                      autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}  "
                               name="name" value="{{ old('name') }}" placeholder="Nombre completo" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}  "
                               name="email" value="{{ old('email') }}" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" readonly
                               class=" form-control{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}  "
                               id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                               placeholder="Fecha nacimiento">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-calendar-alt"></span>
                            </div>
                        </div>

                        @if ($errors->has('fecha_nacimiento'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="number"
                               class="form-control{{ $errors->has('peso') ? ' is-invalid' : '' }}  "
                               value="{{ old('peso') }}" name="peso" placeholder="Peso (Kg)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-balance-scale"></span>
                            </div>
                        </div>

                        @if ($errors->has('peso'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('peso') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="number"
                               class="form-control{{ $errors->has('estatura') ? ' is-invalid' : '' }}  "
                               value="{{ old('estatura') }}" name="estatura" placeholder="Estatura (Cm)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-ruler"></span>
                            </div>
                        </div>

                        @if ($errors->has('estatura'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('estatura') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}  "
                               name="password" placeholder="Contraseña" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control  "
                               name="password_confirmation" placeholder="Repetir contraseña" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 justify-content-center row">
                        <div class="icheck-primary d-inline col-5">
                            <input type="radio" id="radioPrimary1" name="genero" value="H" checked>
                            <label class="   " for="radioPrimary1">
                                Hombre
                            </label>
                        </div>
                        <div class="icheck-danger d-inline col-5">
                            <input type="radio" id="radioPrimary2" name="genero" value="M">
                            <label class="   " for="radioPrimary2">
                                Mujer
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                    class="btn btn-outline-primary btn-block btn-flat">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
