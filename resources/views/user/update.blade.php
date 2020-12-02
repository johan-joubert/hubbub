@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('user.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Prenom</label>
                    <input type="text" name="prenom" id="name" class="form-control" required value="{{ $user->prenom }}">
                </div>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="nom" id="name" class="form-control" required value="{{ $user->nom }}">
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="name">Pseudo</label>
                    <input type="text" name="pseudo" id="name" class="form-control" required value="{{ $user->pseudo }}">
                </div>
                <div class="form-group">
                    <label for="mail">Email</label>
                    <input type="email" name="email" id="mail" class="form-control" required value="{{ $user->email }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    modifier informations
                </button>

            </form>
        </div>
    </div>
</div>
@endsection