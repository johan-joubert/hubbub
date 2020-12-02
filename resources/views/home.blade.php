@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <form action="{{ route('message.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" cols="50" rows="2" name="content" value="{{ old('content') }}"></textarea>
                <input type="text" name="tags" placeholder="tags">
                <input type="text" name="image" placeholder="image">
            </div>
            <input type="submit" class="btn btn-primary" value="Hubb">
        </form>
    </div>


    @foreach($messages as $message)
    <div class="row blocMessage">
        <div class="col-md-12 text-center">
            @if(!isset($_POST['hiddenEdit']))

            <div class="card">

                @if($message->user_id === auth()->user()->id)


                <a href="{{ route('message.edit', $message) }}">
                    <button class="btn btn-secondary">Modifier</button>
                </a>

                <form action="{{ route('message.destroy', $message->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                </form>

                @endif

                <a href="{{ route('message.show', $message) }}">
                    <button class="btn btn-secondary">Zoom sur le Hubb</button>
                </a>


                <div class="card-body">
                    <strong>{{ $message->user->pseudo}}</strong> -
                    {{$message->created_at}} - Modifier le {{$message->updated_at}}
                    <br>
                    {{ $message->image}}
                    {{ $message->content }}
                </div>
                <div class="card-body">
                    {{ '#' .$message->tags }}
                </div>

            </div>
            @endif


        </div>
    </div>


    <form action="{{ route('commentaire.store') }}" method="post" class="mt-3">
        @csrf

        <div class="form-group">
            <textarea name="content" id="" cols="70" rows="2" placeholder="Commentaire..."></textarea>
            <input type="hidden" value="{{$message->id}}" name="messageId">
            <button class="btn btn-dark">Commenter</button>
        </div>
    </form>
    <div class="card mt-8">
        @foreach($message->commentaires as $commentaire)

        @if($commentaire->user_id == auth()->user()->id)

        <div class="row">

            <div class="col-md-6">

                <a href="{{route('commentaire.edit', $commentaire)}}" class="btn btn-primary">
                    Modifier
                </a>
            </div>

            <div class="col-md-6">
                <form action="{{ route('commentaire.destroy', $commentaire->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                </form>
            </div>

        </div>



        @elseif($commentaire->user_id === auth()->user()->id || $message->user_id === auth()->user()->id)

        <form action="{{ route('commentaire.destroy', $commentaire->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
        </form>


        @endif


        <div>
            <strong>{{ $commentaire->user->pseudo }}</strong> -
            {{ $commentaire->created_at->diffForHumans() }}
        </div>
        <div class="card-body">
            {{$commentaire->content}}
        </div>


        @endforeach
    </div>

    @endforeach



</div>
@endsection