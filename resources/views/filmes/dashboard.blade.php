@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Sessões</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($filmes) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filmes as $filme)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/filmes/{{ $filme->id }}">{{ $filme->nome }}</a></td>
                    <td>{{ count($filme->users) }}</td>
                    <td>
                        <a href="/filmes/edit/{{ $filme->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                        <form action="/filmes/{{ $filme->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não tem sessões, <a href="/filmes/create">Criar Sessões</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Sessões que estou participando</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
@if(count($filmesAsParticipant) > 0)
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($filmesAsParticipant as $filme)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td><a href="/filmes/{{ $filme->id }}">{{ $filme->nome }}</a></td>
                <td>{{ count($filme->users) }}</td>
                <td>
                <form action="/filmes/leave/{{ $filme->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon> 
                            Sair da Sessão
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>
@else
<p>Você ainda não está participando de nenhuma sessão <a href="/">veja todos as sessões</a></p>
@endif
</div>

@endsection