@extends('layouts.app')

@section('content')
    <h1>Detalhes da Foto</h1>
    <div class="card">
        <a href="{{ asset('storage/' . $foto->foto_caminho) }}" data-lightbox="galeria" data-title="Foto ID: {{ $foto->id }}">
            <img src="{{ asset('storage/' . $foto->foto_caminho) }}" alt="Foto">
        </a>
        <div class="card-content">
            <p><strong>ID:</strong> {{ $foto->id }}</p>
            <p><strong>Cliente:</strong> {{ $foto->cliente->name ?? 'N/A' }}</p>
            <p><strong>Fotógrafo:</strong> {{ $foto->fotografo->name ?? 'N/A' }}</p>
            <p><strong>Aprovação:</strong> {{ $foto->aprovacao ? 'Aprovado' : 'Desaprovado' }}</p>
            <a href="{{ route('foto_upload.index') }}" class="button">Voltar</a>
        </div>
    </div>
@endsection
