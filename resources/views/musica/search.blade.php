@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
    <div class="columns medium-4">
        <img src="{{ asset('img/opus/banner1.jpg') }}" alt="Opus">
    </div>
    <div class="columns medium-4">
        <div class="search">
            <div class="about">Acerca de Opus</div>
            <div class="searchlabel">Haga aquí su búsqueda
                utilizando uno o más criterios:
            </div>
            <div class="fields">
                <form action="/musica" method="post">
                    {{ csrf_field() }}
                    <div class="field">
                        <label for="name">Artista</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="field">
                        <input type="submit" value="buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="columns medium-4">
        <img src="{{ asset('img/opus/banner2.jpg') }}" alt="Opus">
    </div>

@endsection
