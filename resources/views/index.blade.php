@extends('layouts.appIndex')

@section('content')
<div class="container sectionIndex">
    <div class="row">
        <div class="col-md-6">
            <h1 class="text-left mainTitle">hubbub</h1>
            <h2>Avec Hubbub, refaites le monde</h2>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12 ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror inputConnect " name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror inputConnect" name="password" placeholder="Mot de passe" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row ">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-connect">
                                    {{ __('Login') }}
                                </button>

                            </div>
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link a-center" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                                @endif

                            </div>
                        </div>


                    </form>

                    <hr>

                    <a href="{{ route('register') }}" class=" btn btn-primary text-center btn-createUser">Créer un compte</a>

                </div>
            </div>
        </div>
    </div>




</div>

</div>
@endsection