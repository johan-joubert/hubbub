@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <form action="{{ route('message.update', $message) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" cols="50" rows="2" name="content"  value="{{ $message->content }}">{{ $message->content }}</textarea>
                <input type="text" name="tags" value="{{ $message->tags }}" >
                <input type="text" name="image" value="{{ $message->image }}">
            </div>
            <input type="submit" class="btn btn-primary" value="Hubbe">
        </form>

    </div>


</div>
@endsection