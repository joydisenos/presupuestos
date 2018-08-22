@extends('layouts.principal')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Iniciar Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Mantener sesión abierta
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    Login
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
