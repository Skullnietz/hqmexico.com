@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-info-container"><br>
      <h1 class="title">Inicia Sesión</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <span> <h5>Correo Electrónico</h5> </span>
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div><br>
                        <div>
                            <span> <h5>Contraseña</h5> </span>
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>



                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuerdame') }}
                                    </label>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Entrar') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                    </form>
                </div>
                <div class="image-container" style="background-image:url('images/background-login.png'); background-size:900px; background-position: center">
                    <img  src="images/logohq-removebg-preview.png" style="width:250px;z-index:5" alt="">

                </div>

          </div>
@endsection
