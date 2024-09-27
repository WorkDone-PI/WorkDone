@extends('layouts.app') {{-- Extendendo o layout principal --}}

<header>
        <nav class="navigation">
            <a href="#"><img class="logo" src="{{ asset('img/logoWK.png') }}" alt=""></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
            </ul>
        </nav>
    </header>

@section('content')
<div class="container">
    <div class="card">
        <h1>Editar Perfil de {{ $user->name }}</h1>
        
        <main class="main-content">
            <form action="{{ route('update') }}" method="POST" class="login-form">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="input-group">
                    <label for="description">Descrição:</label>
                    <input type="description" id="description" name="description" value="{{ $user->description }}">
                </div>
                <div class="button-group">
                    <input type="submit" class="submit-btn">
                </div>
                
            </form>
        </main>
    </div>
</div>
@endsection
