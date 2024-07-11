@extends('layouts.app')
@stack('css')

@section('login')
@auth
                    <p>Benvenuto, {{ Auth::user()->name }}</p>
                @else
                    <p>Benvenuto!</p>
                @endauth
@endsection

<!-- Servizi -->
@section('content')

<section class="page-section mx-auto p-2" id="services">
    <div class="container">
        <div class="text-center mx-auto p-5">
            <h2 class="section-heading text-uppercase">Chi Siamo</h2>
            <h3 class="section-subheading text-muted">scopri perchè unirti a noi</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-school fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Scuola</h4>
                <p class="text-muted">Dall’apprendimento della lingua giapponese all’esplorazione dell’arte, della cucina e del cucito tradizionali, troverai il corso perfetto per te. Ogni incontro è un momento di aggregazione e divertimento, dove trovare nuovi amici.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-person-chalkboard fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Sensei</h4>
                <p class="text-muted">I nostri sensei sono giapponesi con una grande esperienza didattica. Imparerai non solo la lingua, ma anche la cultura e le sfumature giapponesi.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-user-group fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Compagni</h4>
                <p class="text-muted">I compagni non sono solo dei semplici studenti, ma veri amici con i quali condividere la passione per il Giappone. Insieme esplorerete a 360° tutta la sua cultura.</p>
            </div>
        </div>
    </div>
</section>


@endsection


<!-- Card corsi-->
@section('corsi')

<section class="page-section">
<div class="container shadow rounded">
    <div class="row text-center">
        @foreach ($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                                
                <div class="card-body img course-item">
                    
                    <h5 class="card-title mx-auto p-2 bg-dark text-white">{{ $course->title }}</h5>
                
                    <div class="course-poster overflow-hidden">
                        @if (filter_var($course->poster, FILTER_VALIDATE_URL))
                                <img src="{{ $course->poster }}" alt="{{ $course->title }}" class="img-thumbnail"
                                    style="max-width: 150px;">
                                @elseif($course->poster === null)
                                <img src="https://cdn.pixabay.com/photo/2023/08/11/16/50/water-8183918_1280.jpg" class="img-thumbnail"
                                style="max-width: 150px;">
                                @else
                                <img src="{{ asset('storage/' . $course->poster) }}" alt="{{ $course->title }}"
                                    class="img-thumbnail" style="max-width: 150px;">
                                @endif
                    </div>

                    <p class="card-text"><strong>Sensei:</strong> 
                        <ul class="list-unstyled">
                            @foreach ($course->teachers as $teacher)
                            <li>{{ $teacher->name }}</li>
                            @endforeach
                        </ul>
                    </p>
                    <p class="card-text"><strong>Laboratorio:</strong> {{ $course->room->name }}</p>
                    
                </div>

                <button class="accordion">Descrizione</button>
                <div class="panel">
                <p>{{$course->description}}</p>
                </div>
               

            </div>
        </div>
        @endforeach
    </div>

    
    <!-- Paginazione -->
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Link alla pagina precedente --}}
                @if ($courses->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($courses->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    
    {{-- Mostra i risultati --}}
    <div class="text-center">
        <p>
            {{ __('pagination.showing_results', [
                'first' => $courses->firstItem(),
                'last' => $courses->lastItem(),
                'total' => $courses->total(),
            ]) }}
        </p>
    </div>
    
    
</div>
@stack('scripts')
@endsection
</section>
