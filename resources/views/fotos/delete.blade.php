@extends('layouts.app')

@section('content')
    <h1>Deletar Foto</h1>
    <p>Tem certeza que deseja deletar esta foto?</p>
    <form class="form" action="{{ route('foto_upload.destroy', App\Services\Operators::EncryptValue($foto->id)) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('foto_upload.index') }}">Cancelar</a>
@endsection
