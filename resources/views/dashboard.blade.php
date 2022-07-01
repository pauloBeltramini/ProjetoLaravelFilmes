@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Sessões</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($filmes) > 0)
    @else
    <p>Você ainda não tem sessões cadastradas, <a href="/filmes/create">Criar sessão</a></p>
    @endif
</div>

@endsection