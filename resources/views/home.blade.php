@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('message.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" cols="50" rows="2" name="content" value="{{ old('content') }}"></textarea>
                <input type="text" name="tags" placeholder="tags">
                <input type="text"  name="image" placeholder="image">
            </div>
            <input type="submit" class="btn btn-primary" value="Hubbe">
        </form>
    </div>

    @foreach($messages as $message)
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $message->content }}
                {{ $message->tags }}
                {{ $message->image}}
            </div>
        </div>

    @endforeach

</div>
@endsection