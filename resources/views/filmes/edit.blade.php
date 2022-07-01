@extends('layouts.main')

@section('title', 'Editando: ' . $filme->nome)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{ $filme->nome }}</h1>
  <form action="/filmes/update/{{ $filme->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="image">Imagem da Sessão:</label>
      <input type="file" id="image" name="image" class="from-control-file">
      <img src="/img/filmes/{{ $filme->image }}" alt="{{ $filme->nome }}" class="img-preview">
    </div>

    <div class="form-group">
      <label for="title">Filme:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do filme" value="{{ $filme->nome }}">
    </div>

    <div class="form-group">
      <label for="title">Gênero</label>
      <select name="genero" id="gener" class="form-control">
        <option value="0" {{ $filme->genero == 0 ? "selected='selected'" : "" }}>Ação</option>
        <option value="1" {{ $filme->genero == 1 ? "selected='selected'" : "" }}>Aventura</option>
        <option value="2" {{ $filme->genero == 2 ? "selected='selected'" : "" }}>Romance</option>
        <option value="3" {{ $filme->genero == 3 ? "selected='selected'" : "" }}>Terror</option>
      </select>
    </div>

    <div class="form-group">
      <label for="title">Ano:</label>
      <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano do filme" value="{{ $filme->ano }}">
    </div>

    <div class="form-group">
      <label for="title">Sinopse:</label>
      <textarea name="sinopse" id="sinopse" class="form-control" placeholder="Uma breve sinopse do filme">{{ $filme->sinopse }}</textarea>
    </div>

    <div class="form-group">
      <label for="title">Link:</label>
      <input type="url" class="form-control" id="link" name="link" placeholder="Link" value="{{ $filme->link }}">
    </div>

    <div class="form-group">
      <label for="date">Data da sessão:</label>
      <input type="date" class="form-control" id="date" name="date" value="{{ $filme->date->format('Y-m-d') }}">
    </div>

    <div class="form-group">
      <label for="title">Cidade:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Local da sessão" value="{{ $filme->city }}">
    </div>

    <div class="form-group">
      <label for="title">Local:</label>
      <input type="text" class="form-control" id="local" name="local" placeholder="Local da sessão" value="{{ $filme->local }}">
    </div>

    <input type="submit" class="btn btn-primary" value="Editar Evento">
  </form>
</div>

@endsection