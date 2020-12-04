@extends('layouts.appIndex')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-3">

            <a class="navbar-brand titleApp text-left" href="{{ url('/') }}">
                <img src="/images/logo.png" alt="" width="50">
            </a>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else

                    <div class="" aria-labelledby="navbarDropdown">
                                    <a id="navbarDropdown" class="nav-link text-left m-2 namePseudo" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->pseudo }}
                                    </a>

                                    <a href="{{ route('user.account') }}" class="linkProfil text-left m-2 linkProfil"><i class="far fa-user iconProfil"></i> Profil</a>
                                        
                                    <a href="{{ route('logout') }}" class="text-left m-2 linkLogout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt iconLogout"></i> {{ __('Logout') }}
                                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none ">
                            @csrf
                        </form>

                    </div>
                @endguest
            </ul>


        </div>

        <div class="col-md-6 ">

            <div class="row justify-content-center blocNewHubb">

                <form action="{{ route('message.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12 form-group">
                        <input type="text" class="areaHubb" name="content" placeholder="Refaites le monde" value="{{ old('content') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group m-3">
                            <input type="text" class="inputTags" name="tags" placeholder="Ajouter un tags" required>
                        </div>
                        <div class="col-md-3 form-group m-3">
                            <input type="text" class="inputImage" name="image" placeholder="image">
                        </div>
                        <div class="col-md-3 form-group mr-auto">
                            <input type="submit" class="btn btnHubb align-items-center" value="Hubb">
                        </div>
                    </div>
                </form>

            </div>


            @foreach($messages as $message)
            <div class="row blocMessage mt-5">
                <div class="col-md-12 text-center">

                    <div class="card blocHubb">

                        <div class="row">

                            <div class="col-md-8">

                                <div class="card-body blocPseudoDate">
                                    <p><strong id="pseudoHubb">{{ $message->user->pseudo}} - </strong> {{$message->created_at}}</p>
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
                                <img src="/images/{{ $message->image}}" alt="" class="w-50">
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



            <div class="card mt-8">
                <p class="mb-0">
                    <a class="btn btnComment"  data-toggle="collapse" href="#multiCollapseExample1{{$message->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Commentaire(s) </a>
                </p>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1{{$message->id}}">
                            <div class="card card-body">
                                <form action="{{ route('commentaire.store') }}" method="post" class="mt-3">
                                    @csrf

                                    <div class="form-group">
                                        <div class="form-group mb-0  ml">
                                            <textarea class="form-control" name="content" id="" cols="20" rows="1" placeholder="Commentaire..."></textarea>
                                        </div>
                                        <input type="text" class="inputImage mt-2" name="imageComments" placeholder="ajouter une image"><i class="far fa-images"></i></input>

                                        <div class="form-group mt-2 mb-0  ">
                                            <input type="hidden" value="{{$message->id}}" name="messageId">
                                            <button class="btn btn-info ml-1">Commenter</button>
                                        </div>
                                    </div>
                                </form>

                                @foreach($message->commentaires as $commentaire)

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                            <p><strong>{{ $commentaire->user->pseudo }}</strong> - {{ $commentaire->created_at }}</p>
                                        </div>
                                    </div>

                                    @can('update', $commentaire)

                                    <div class="col-md-2">

                                        <a href="{{route('commentaire.edit', $commentaire)}}" class="btn">
                                            <i class="fas fa-edit "></i>
                                        </a>

                                    </div>

                                    @endcan

                                    @can('delete', $commentaire)

                                    <div class="col-md-2">
                                        <form action="{{ route('commentaire.destroy', $commentaire->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>

                                    @endcan

                                </div>
                                <div class="row">

                                    <div class="col-md-12 text-center card-body">
                                    <img src="/images/{{ $commentaire->image}}" alt="" width="150">
                                    <br>
                                        {{$commentaire->content}}
                                    </div>
                                    <hr>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach


        </div>

        <div class="col-md-3">

            @include('partials.search')

        </div>

    </div>




</div>
@endsection