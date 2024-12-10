@extends('layouts.app')

@section('content')
    <h1>Editar Foto</h1>
    <form class="form" action="{{ route('foto_upload.update', App\Services\Operators::EncryptValue($foto->id)) }}" method="POST" enctype="multipart/form-data">
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
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex justify-between items-center" style="background-color: #721C24; border-color: #F5C6CB; color: #F8D7DA;" role="alert">
                <span>{{ $message }}</span>
                <span class="px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                        <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.934 2.934a1 1 0 010 1.415z"/>
                    </svg>
                </span>
            </div>
        @enderror

        <select name="aprovacao">
            <option value="">Selecione a aprovação</option>
            <option value="1" {{ $foto->aprovacao ? 'selected' : '' }}>Aprovado</option>
            <option value="0" {{ !$foto->aprovacao ? 'selected' : '' }}>Desaprovado</option>
        </select>
        @error('aprovacao')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex justify-between items-center" style="background-color: #721C24; border-color: #F5C6CB; color: #F8D7DA;" role="alert">
                <span>{{ $message }}</span>
                <span class="px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                        <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.934 2.934a1 1 0 010 1.415z"/>
                    </svg>
                </span>
            </div>
        @enderror

        <button type="submit">Salvar</button>
    </form>
@endsection
