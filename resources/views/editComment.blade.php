@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <form action="{{ route('commentaire.update', $commentaire) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" cols="50" rows="2" name="commentContent"  value="{{ $commentaire->content }}">{{ $commentaire->content }}</textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Hubbe">
        </form>

    </div>


</div>
@endsection