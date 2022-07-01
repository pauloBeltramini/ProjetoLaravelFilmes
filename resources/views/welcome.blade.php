@extends('layouts.main')

@section('title', 'Sessões Filmes')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque uma sessão</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{ $search }}</h2>
    @else
        <h2>Próximas Sessões</h2>
        <p class="subtitle">Veja as sessões dos próximos dias</p>
    @endif

    <div id="cards-container" class="row">
        @foreach($filmes as $filme)
        <div class="card col-md-3">
            <img src="/img/filmes/{{ $filme->image }}" alt="{{ $filme->nome }}">
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($filme->date)) }}</p>
                <h5 class="card-title">{{ $filme->nome }}</h5>
                <p class="card-participants">{{ count($filme->users) }}  Participantes</p>
                <a href="/filmes/{{ $filme->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach

        @if(count($filmes) == 0 && $search)
            <p>Não foi possível encontrar nenhuma sessão com {{ $search }}! <a href="/">Ver todas</a></p>
        @elseif(count($filmes) == 0)
            <p>Não há sesões disponíveis</p>
        @endif
    </div>
</div>

@endsection