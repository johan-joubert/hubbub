@extends('layouts.app')

@section('content')

@foreach($user->messages as $message)
            <div class="row blocMessage mt-5">
                <div class="col-md-12 text-center">

                    <div class="card">

                        <div class="row">

                            <div class="col-md-8">

                                <div class="card-body blocPseudoDate">
                                    <p><strong id="pseudoHubb">{{ $message->user->pseudo}} - </strong>{{$message->created_at}}</p>
                                    <br>
                                </div>

                            </div>

                            <div class="col-md-4 mt-4">

                                <p>
                                    <button class="btn btnThreePoints" type="button" data-toggle="collapse" data-target="#collapseExample{{$message->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        ...
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample{{$message->id}}">
                                    <div class="card card-body">
                                        @can('update', $message)

                                        <a href="{{ route('message.edit', $message) }}" class="text-left">
                                            <button class="btnEdit "><i class="fas fa-edit "></i>Modifier</button>
                                        </a>
                                        @endcan

                                        @can('delete', $message)

                                        <form action="{{ route('message.destroy', $message->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btnEdit text-left"><i class="fas fa-trash-alt"></i>Supprimer</button>
                                        </form>

                                        @endcan

                                        <a href="{{ route('message.show', $message) }}">
                                            <button class="btnEdit text-left"><i class="fas fa-search-plus"></i>Zoom</button>
                                        </a>


                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <img src="/images/{{ $message->image}}" alt="" width="150">
                                <br>
                                {{ $message->content }}
                                <div class="card-body">
                                    {{ '#' .$message->tags }}
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

@endforeach

@endsection