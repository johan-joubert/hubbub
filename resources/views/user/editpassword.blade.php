@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('user.updatePassword') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Ancien mot de pass</label>
                    <input type="password" name="oldPassword" id="name" class="form-control" required placeholder="ancien mot de passe">
                </div>
                <div class="form-group">
                    <label for="name">nouveau mot de passe</label>
                    <input type="password" name="newPassword" id="name" class="form-control" required placeholder="nouveau">
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="name">Confirmer nouveau mot de passe</label>
                    <input type="password" name="confirmNewPassword" id="name" class="form-control" required placeholder="confirmer">
                </div>
                <button type="submit" class="btn btn-primary">
                    modifier informations
                </button>

            </form>
        </div>
    </div>
</div>
@endsection