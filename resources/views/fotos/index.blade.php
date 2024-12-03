@extends('layouts.app')

@section('content')
    <h1>Lista de Fotos</h1>
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'fotografo')
        <a href="{{ route('foto_upload.create') }}" class="button">Adicionar Nova Foto</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fotógrafo</th>
                <th>Foto</th>
                <th>Aprovação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fotos as $foto)
                <tr>
                    <td>{{ $foto->id }}</td>
                    <td>{{ $foto->cliente->name ?? 'N/A' }}</td>
                    <td>{{ $foto->fotografo->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $foto->foto_caminho) }}" data-lightbox="galeria" data-title="Foto ID: {{ $foto->id }}">
                            <img src="{{ asset('storage/' . $foto->foto_caminho) }}" alt="Foto" width="100">
                        </a>
                    </td>
                    <td>{{ $foto->aprovacao ? 'Aprovado' : 'Desaprovado' }}</td>
                    <td>
                        <a href="{{ route('foto_upload.show', $foto->id) }}" class="button">Ver</a>
                        @if(Auth::user()->role == 'admin' || Auth::user()->id == $foto->fotografo_id)
                            <a href="{{ route('foto_upload.edit', $foto->id) }}" class="button">Editar</a>
                            <form action="{{ route('foto_upload.destroy', $foto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Deletar</button>
                            </form>
                        @elseif(Auth::user()->id == $foto->cliente_id)
                            <form action="{{ route('foto_upload.update', $foto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <select name="aprovacao">
                                    <option value="1" {{ $foto->aprovacao ? 'selected' : '' }}>Aprovado</option>
                                    <option value="0" {{ !$foto->aprovacao ? 'selected' : '' }}>Desaprovado</option>
                                </select>
                                <button type="submit">Salvar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
