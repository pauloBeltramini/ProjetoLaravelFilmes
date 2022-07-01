<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\User;

class FilmeController extends Controller
{
    public function index() {
        $search = request('search');

        if($search) {
            $filmes = Filme::where([
                ['nome', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $filmes = Filme::all();
        }        
    
        return view('welcome',['filmes' => $filmes, 'search' => $search]);
    }

    public function create() {
        return view('filmes.create');
    }

    public function store(Request $request) {
        $filme = new Filme;

        $filme->nome = $request->nome;
        $filme->genero = $request->genero;
        $filme->ano= $request->ano;
        $filme->sinopse = $request->sinopse;
        $filme->link = $request->link;
        $filme->date = $request->date;
        $filme->city = $request->city;
        $filme->local = $request->local;
        
         // Image Upload
         if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/filmes'), $imageName);

            $filme->image = $imageName;
        }

        $user = auth()->user();
        $filme->user_id = $user->id;

        $filme->save();

        return redirect('/')->with('msg', 'Sessão criada com sucesso!');
    }
    
    public function show($id) {
        $filme = Filme::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {

            $userFilmes = $user->filmesAsParticipant->toArray();

            foreach($userFilmes as $userFilme) {
                if($userFilme['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        $filmeOwner = User::where('id', $filme->user_id)->first()->toArray();

        return view('filmes.show', ['filme' => $filme, 'filmeOwner' => $filmeOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        $user = auth()->user();

        $filmes = $user->filmes;

        $filmesAsParticipant = $user->filmesAsParticipant;

        return view('filmes.dashboard', 
            ['filmes' => $filmes, 'filmesAsParticipant' => $filmesAsParticipant]
        );
    }

    public function destroy($id) {
        Filme::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Sessão excluída com sucesso!');
    }

    public function edit($id) {
        $user = auth()->user();

        $filme = Filme::findOrFail($id);

        if($user->id != $filme->user_id) {
            return redirect('/dashboard');
        }

        return view('filmes.edit', ['filme' => $filme]);

    }

    public function update(Request $request) {
        $data = $request->all();

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/filmes'), $imageName);

            $data['image'] = $imageName;

        }

        Filme::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Sessão editada com sucesso!');
    }

    
    public function joinFilme($id) {
        $user = auth()->user();

        $user->filmesAsParticipant()->attach($id);

        $filme = Filme::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada na sessão ' . $filme->nome);
    }

    public function leaveFilme($id) {
        $user = auth()->user();

        $user->filmesAsParticipant()->detach($id);

        $filme = Filme::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso da sessão: ' . $filme->nome);
    }

}
