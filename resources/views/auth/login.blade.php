@extends('layouts.auth')

@section('content')
<div class="auth-page">
    <div>
        <div class="auth-card">
            <div class="auth-brand">
                <div class="auth-icon">
                    <i class="fa fa-lock"></i>
                </div>
                <h1>GLB COLLECTION</h1>
                <p>Inicio de Sesión</p>
            </div>

            <form class="auth-form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="checkbox-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recordarme</label>
                </div>

                <button type="submit" class="auth-submit">
                    <i class="fa fa-sign-in"></i>Acceder
                </button>
            </form>
        </div>

        <div class="auth-footer">
            &copy; {{ date('Y') }} GLB COLLECTION
        </div>
    </div>
</div>
@endsection
