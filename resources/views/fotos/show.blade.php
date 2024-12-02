@extends('layouts.app')

@section('content')
    <h1>Detalhes da Foto</h1>
    <p>ID: {{ $foto->id }}</p>
    <p>Cliente: {{ $foto->cliente->name ?? 'N/A' }}</p>
    <p>Fotógrafo: {{ $foto->fotografo->name ?? 'N/A' }}</p>
    <p>Foto: <img src="{{ asset('storage/' . $foto->foto_caminho) }}" alt="Foto" width="300"></p>
    <p>Aprovação: {{ $foto->aprovacao ? 'Aprovado' : 'Desaprovado' }}</p>
    <a href="{{ route('foto_upload.index') }}">Voltar</a>
@endsection
