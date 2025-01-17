<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Support\Str;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = auth()->user()->admin ? Team::all() : auth()->user()->teams;

        return view('teams.index', ['teams' => $teams]);
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store()
    {
        $this->authorize('create', Team::class);
        Team::create([
            'name'              => request('name'),
            'email'             => request('email'),
            'slack_webhook_url' => request('slack_webhook_url'),
            'token'             => Str::random(24),
        ]);

        return redirect()->route('teams.index');
    }

    public function edit(Team $team)
    {
        return view('teams.edit', ['team' => $team]);
    }

   
    public function update(Team $team)
    {
        $team->update([
            'name'              => request('name'),
            'email'             => request('email'),
            'slack_webhook_url' => request('slack_webhook_url'),
            'token'             => Str::random(24),
        ]);

        return redirect()->route('teams.index');
    }

    public function destroy(Team $team)
    {
        
     $Thisteam=Team::where('id',$team['id']);
     $Thisteam->delete();
     return redirect()->route('teams.index');
    }
}
