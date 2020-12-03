@extends('layouts.app')

@section('content')

    @foreach($messages as $message)
                <div class="card-body">
                <strong>{{ $message->pseudo}}</strong> -
                    {{$message->created_at}} - Modifier le {{$message->updated_at}}
                    <br>
                    {{ $message->postMessage}}                    
                </div>
                <div class="card-body">
                    {{ '#' .$message->tags }}
                </div>
                <div class="card-body">

                
    @endforeach

@endsection