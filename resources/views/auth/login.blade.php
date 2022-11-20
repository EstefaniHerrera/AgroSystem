@extends('layouts.Main', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('')])
@section('content')
<style>
    .btn {
            color: #fff;
            border: none;
            background: linear-gradient(to right, rgb(65, 145, 126), #5fc481);
            padding: 10px 80px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 5px;
            text-align: center;
        }
</style>

    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-success text-center" style="background: linear-gradient(to right, rgb(65, 145, 126), #5fc481);">
                            <h4 class="card-title"><strong>{{ __('Inicio de sesión') }}</strong></h4>
                        </div>
                        <br>
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-success">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('mensaje'))
                                <div class="alert alert-danger">
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- NOMBRE DE USUARIO --}}
                            <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <br><br>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="{{ __('Nombre de usuario...') }}" value="{{ old('username') }}"
                                        required autocomplete="username" autofocus onkeypress="return fSoloLetras(event);" maxlength="40" minlength="3">
                                </div>
                            </div>

                            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            {{-- <i class="material-icons">lock_outline</i> --}}
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="{{ __('Contraseña...') }}" required autocomplete="password" autofocus maxlength="20" minlength="8">
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                                @if (Route::has('usuarios.cambiar_contrasena'))
                                    <a href="{{ route('usuarios.cambiar_contrasena') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-success">{{ __('Ingresar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @push('alertas')
        <script>
            function fSoloLetras(evt) {
                var code = (evt.which) ? evt.which : evt.keyCode;
                if (code == 45 || code == 46) {
                    return true;
                } else if (code >= 65) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    @endpush
@endsection
