@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Crée le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td>{{$user['prenom']}}</td>
                                <td>{{$user['nom']}}</td>
                                <td>{{$user['pseudo']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['created_at']}}</td>
                                <td>
                                   <a class="btn btn-warning" href="{{ route('user.update') }}">Modifier</a>
                                </td>
                                <td>
                                   <a class="btn btn-warning" href="{{ route('user.updatePassword') }}">Modifier mot de passe</a>
                                </td>
                            </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-md-6">
            <a href="#">historique des Hubes</a>
        </div>
    </div>
@endsection