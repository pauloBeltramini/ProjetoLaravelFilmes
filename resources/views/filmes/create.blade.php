@extends('layouts.main')

@section('title', 'Criar Sessão Filme')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Criar Sessão</h1>
  <form action="/filmes" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="image">Imagem do Filme:</label>
      <input type="file" id="image" name="image" class="from-control-file">
    </div>

    <div class="form-group">
      <label for="title">Filme:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do filme">
    </div>

    <div class="form-group">
      <label for="title">Gênero:</label>
      <select name="genero" id="genero" class="form-control">
        <option value="0">Ação</option>
        <option value="1">Aventura</option>
        <option value="2">Romance</option>
        <option value="3">Terror</option>
      </select>
    </div>

    <div class="form-group">
      <label for="title">Ano:</label>
      <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano do filme">
    </div>

    <div class="form-group">
      <label for="title">Sinopse:</label>
      <textarea name="sinopse" id="sinopse" class="form-control" placeholder="Uma breve sinopse do filme"></textarea>
    </div>

    <div class="form-group">
      <label for="title">Link:</label>
      <input type="url" class="form-control" id="link" name="link" placeholder="Link">
    </div>

    <div class="form-group">
      <label for="date">Data da sessão:</label>
      <input type="date" class="form-control" id="date" name="date">
    </div>

    <div class="form-group">
      <label for="title">Cidade:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Cidade da sessão">
    </div>

    <div class="form-group">
      <label for="title">Local:</label>
      <input type="text" class="form-control" id="local" name="local" placeholder="Local da sessão">
    </div>

    <input type="submit" class="btn btn-primary" value="Criar Sessão">
  </form>
</div>

@endsection