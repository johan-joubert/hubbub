@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">{{$user['prenom']}}</li>
                    <li class="list-group-item text-center">{{$user['nom']}}</li>
                    <li class="list-group-item text-center">{{$user['pseudo']}}</li>
                    <li class="list-group-item text-center">{{$user['email']}}</li>
                    <li class="list-group-item text-center">{{$user['created_at']}}</li>
                    <li class="list-group-ite text-center mb-2"><a class="btn btnEditInfo" href="{{ route('user.update') }}">Modifier mes informations</a></li>
                    <li class="list-group-ite text-center mb-2"><a class="btn btnEditInfo" href="{{ route('user.updatePassword') }}">Modifier mot de passe</a></li>
                    <li class="list-group-ite text-center"><a href="{{ route('user.showHubb') }}"class="btn btnEditInfo">Historique des Hubes</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection