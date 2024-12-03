@extends('layouts.app')

@section('content')
    <h1>Editar Foto</h1>
    <form class="form" action="{{ route('foto_upload.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <select name="cliente_id">
            <option value="">Selecione um cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ $foto->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->name }}</option>
            @endforeach
        </select>

        <select name="fotografo_id">
            <option value="">Selecione um fotógrafo</option>
            @foreach($fotografos as $fotografo)
                <option value="{{ $fotografo->id }}" {{ $foto->fotografo_id == $fotografo->id ? 'selected' : '' }}>{{ $fotografo->name }}</option>
            @endforeach
        </select>

        <input type="file" name="foto_caminho">
        @error('foto_caminho')
            {{ $message }}
        @enderror

        <select name="aprovacao">
            <option value="">Selecione a aprovação</option>
            <option value="1" {{ $foto->aprovacao ? 'selected' : '' }}>Aprovado</option>
            <option value="0" {{ !$foto->aprovacao ? 'selected' : '' }}>Desaprovado</option>
        </select>
        @error('aprovacao')
            {{ $message }}
        @enderror

        <button type="submit">Salvar</button>
    </form>
@endsection
