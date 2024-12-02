@extends('layouts.app')

@section('content')
    <h1>Upload de Foto</h1>
    <form action="{{ route('foto_upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <select name="cliente_id">
            <option value="">Selecione um cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
            @endforeach
        </select>

        <select name="fotografo_id">
            <option value="">Selecione um fotógrafo</option>
            @foreach($fotografos as $fotografo)
                <option value="{{ $fotografo->id }}">{{ $fotografo->name }}</option>
            @endforeach
        </select>

        <input type="file" name="foto_caminho">
        
        <select name="aprovacao">
            <option value="">Selecione a aprovação</option>
            <option value="1">Aprovado</option>
            <option value="0">Desaprovado</option>
        </select>

        <button type="submit">Salvar</button>
    </form>
@endsection
