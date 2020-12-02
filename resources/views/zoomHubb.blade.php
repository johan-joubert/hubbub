@extends('layouts.app')

@section('content')

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


                
                <div class="card-body">
                    <strong>{{ $message->user->pseudo}}</strong> -
                    {{$message->created_at}} - Modifier le {{$message->updated_at}}
                    <br>
                    {{ $message->pseudo}}
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

                <a href="{{route('commentaire.edit', $commentaire)}}" class="btn btn-primary" >
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

@endsection