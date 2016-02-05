@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
    <div class="search">
        <div class="about">Acerca de Opus</div>
        <div class="searchlabel">Haga aquí su búsqueda
            utilizando uno o más criterios:
        </div>
        <div class="fields">
            <form action="/opus" method="post">
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
@endsection
