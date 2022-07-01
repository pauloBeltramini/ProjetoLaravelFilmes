@extends('layouts.main')

@section('title', $filme->nome)

@section('content')

  <div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/filmes/{{ $filme->image }}" class="img-fluid" alt="{{ $filme->nome }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $filme->nome }}</h1>
        <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $filme->city }} - {{ $filme->local }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{ count($filme->users) }} Participantes</p>
        <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{ $filmeOwner['name'] }}</p>
        @if(!$hasUserJoined)
          <form action="/filmes/join/{{ $filme->id }}" method="POST">
            @csrf
            <a href="/filmes/join/{{ $filme->id }}" 
              class="btn btn-primary" 
              id="event-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              Confirmar Presença
            </a>
          </form>
        @else
          <p class="already-joined-msg">Você já está participando desta sessão!</p>
        @endif
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Sobre a sessão sessão:</h3>
        <p class="event-description">{{ $filme->sinopse }}</p>
      </div>
    </div>
  </div>

@endsection