@extends('layouts.app')

@section('title')
    Opus @parent
@endsection

@section('content')
<div class="content-wrapper">
  <div class="row columns">
    <div class="columns large-centered medium-10">
      <div class="columns medium-10 padding-button">
        <h5>Acerca de Opus</h5>
        <span class="red">Histórico de conciertos del banco de la república</span>
      </div>
      <div class="columns medium-12">
        <div class="row">
          <div class="columns medium-6">
            <img src="{{asset('img/imagen_acerca_de.png')}}">
          </div>
          <div class="columns medium-6">
              <div>
                <p class="red">Desde 1966 la Temporada Nacional de Conciertos Banco de la República ofrece
                  al público colombiano una selección de los mejores solistas y ensambles de
                  música de cámara del panorama nacional e internacional. Hemos creado esta
                   base de datos para que estudiantes, gestores culturales, programadores,
                   artistas, investigadores, curiosos y todo el público asistente pueda
                   explorar y conocer la historia de la programación de la Sala de Conciertos
                    de la Biblioteca Luis Ángel Arango durante estos años.<br>
                Conscientes de la diversidad de lenguajes, estilos y representaciones que
                tiene la música de cámara, la programación incluye varias franjas que reflejan
                y resaltan las características y variedad que contiene cada género.</p>
                <ul>
                  <li>Música antigua para nuestro tiempo</li>
                  <li>Recorridos por la música de cámara</li>
                  <li>Retratos de un compositor</li>
                  <li>Música y músicos de Latinoamérica y el mundo</li>
                  <li>Música y músicos de Latinoamérica y el mundo</li>
                  <li>La música en familia</li>
                  <li>Conciertos didácticos</li>
                  <li>Serie de los Jóvenes Intérpretes</li>
                </ul>
                <p class="red">Además de cada línea de programación, usted podrá explorar los instrumentos,
                  formatos, países; los  nombres los compositores; los escenarios y la historia
                  detrás de cada programa ya que en cada concierto usted encontrará las notas al
                  programa comisionadas, éstas se convierten en un verdadero tesoro, ya que tienen
                  contenidos, historia y descripciones detalladas detrás de cada programa musical
                  entre biografías, anécdotas y completas investigaciones que reflejan el poder
                  de multiplicar el conocimiento a través de las diferentes dimensiones que
                  ofrece la música.
                </p>

              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
