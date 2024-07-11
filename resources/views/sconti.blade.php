@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                
                @auth
                <h1><em> Ciao {{ Auth::user()->name }}!</em></h1>
                    <h3>Questa è la tua area personale con gli sconti a te riservati!</h3>
                @else
                    <p>Benvenuto!</p>
                @endauth
            </div>
        </div>
    </div>

    <div class="container d-flex align-items-center flex-column py-5">
        <div class="card codice-sconto" style="width:500px">
            <img class="card-img-top" src="css/img/fiori_ciliegio.jpg" alt="sconti">
            <div class="card-img-overlay">
              <h3 class="card-title"><strong>{{ Auth::user()->name }}</strong></h3>
              <p class="card-text"><strong>uno sconto esclusivo solo per te! <br>Passa il mouse e scopri il codice</strong></p>
              <div class="layover"><span>WELCOME10</span></div>
              
            </div>
          </div>

    </div>
@endsection