<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FotoUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Foto_upload_controller extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $fotos = FotoUpload::all();
        } else {
            $fotos = FotoUpload::where('cliente_id', $user->id)
                                ->orWhere('fotografo_id', $user->id)
                                ->get();
        }

        return view('fotos.index', compact('fotos'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role == 'admin' || $user->role == 'fotografo') {
            $clientes = User::where('role', 'cliente')->get(); 
            $fotografos = User::where('role', 'fotografo')->get();

            return view('fotos.create', compact('clientes', 'fotografos'));
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para criar uma foto.');
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin' || $user->role == 'fotografo') {
            $validatedData = $request->validate(
            [ 
                'cliente_id' => 'nullable|exists:users,id', 
                'fotografo_id' => 'nullable|exists:users,id',
                'foto_caminho' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'aprovacao' => 'nullable|boolean',
            ],
            [
                'foto_caminho.required' => 'A imagem é obrigatória.',
                'aprovacao.boolean' => 'Erro de tipo de dados.',
            ]
            );

            if ($request->hasFile('foto_caminho')) {
                $file = $request->file('foto_caminho');
                $path = $file->store('fotos', 'public');
                $validatedData['foto_caminho'] = $path;
            }

            FotoUpload::create($validatedData);

            return redirect()->route('foto_upload.index')->with('success', 'Foto enviada com sucesso!');
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para criar uma foto.');
        }
    }

    public function show($id)
    {
        $foto = FotoUpload::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin' || $user->id == $foto->cliente_id || $user->id == $foto->fotografo_id) {
            return view('fotos.show', compact('foto'));
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para ver esta foto.');
        }
    }

    public function edit($id)
    {
        $foto = FotoUpload::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin' || $user->id == $foto->fotografo_id) {
            $clientes = User::where('role', 'cliente')->get(); 
            $fotografos = User::where('role', 'fotografo')->get();

            return view('fotos.edit', compact('foto', 'clientes', 'fotografos'));
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para editar esta foto.');
        }
    }

    public function update(Request $request, $id)
    {
        $foto = FotoUpload::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin' || $user->id == $foto->fotografo_id) {
            $validatedData = $request->validate([ 
                'cliente_id' => 'nullable|exists:users,id', 
                'fotografo_id' => 'nullable|exists:users,id',
                'foto_caminho' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'aprovacao' => 'boolean',
            ],
            [
                'foto_caminho.image' => 'O arquivo deve ser uma imagem.',
                'foto_caminho.mimes' => 'É permitido apenas arquivos do tipo jpeg,png,jpg,gif.',
                'foto_caminho.max' => 'A imagem ultrapassa o máximo permitido que é 2048.',
                'aprovacao.boolean' => 'Erro de tipo de dados',
            ]
            );

            if ($request->hasFile('foto_caminho')) {
                $file = $request->file('foto_caminho');
                $path = $file->store('fotos', 'public');
                $validatedData['foto_caminho'] = $path;
            }

            $foto->update($validatedData);

            return redirect()->route('foto_upload.index')->with('success', 'Foto atualizada com sucesso!');
        } elseif ($user->id == $foto->cliente_id) {
            $validatedData = $request->validate([
                'aprovacao' => 'required|boolean',
            ]);

            $foto->update(['aprovacao' => $validatedData['aprovacao']]);

            return redirect()->route('foto_upload.index')->with('success', 'Aprovação atualizada com sucesso!');
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para atualizar esta foto.');
        }
    }

    public function destroy($id)
    {
        $foto = FotoUpload::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin' || $user->id == $foto->fotografo_id) {
            // Apagar o arquivo de foto salvo no servidor
            if ($foto->foto_caminho) {
                Storage::disk('public')->delete($foto->foto_caminho);
            }

            $foto->delete();

            return redirect()->route('foto_upload.index')->with('success', 'Foto deletada com sucesso!');
        } else {
            return redirect()->route('foto_upload.index')->with('error', 'Você não tem permissão para deletar esta foto.');
        }
    }
}
