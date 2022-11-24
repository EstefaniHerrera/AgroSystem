@extends('layouts.Main', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material Dashboard')])
@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" >
        @csrf
        <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title"><strong>{{ __('Registro de usuarios') }}</strong></h4>
            </div>
          <br>
          <div class="card-body ">
                <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">face</i>
                    </span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="{{ __('Nombre...') }}" value="{{ old('name') }}"
                    required autocomplete="name" autofocus>
                </div>
                @if ($errors->has('name'))
                    <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                    <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
                </div>

                <!-- NOMBRE DE USUARIO -->
                <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">fingerprint</i>
                        </span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="{{ __('Nombre de usuario...') }}" value="{{ old('username') }}"
                    required autocomplete="username">
                    </div>
                    @if ($errors->has('username'))
                    <div id="username-error" class="error text-danger pl-3" for="username" style="display: block;">
                        <strong>{{ $errors->first('username') }}</strong>
                    </div>
                    @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">email</i>
                        </span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="{{ __('Correo Electronico...') }}" value="{{ old('email') }}"
                        required autocomplete="email" >
                    </div>
                    @if ($errors->has('email'))
                        <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                        <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Contrasena...') }}"
                        required autocomplete="new-password">
                    </div>
                    @if ($errors->has('password'))
                        <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                        <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirmar contrasena...') }}"
                        required autocomplete="new-password">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Crear usuario') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
