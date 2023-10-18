@extends('layouts.app')

@section('title', 'Pagina principal')

@section('content')
    <x-listar-post :posts='$posts'/>
@endsection
