@extends('layouts.app')

@section('content')
<div class="container text-center">
    
    <h2>Risultati della ricerca</h2>
    <div class="row">
        @if($courses->isEmpty())
         <h2>Nessun risultato</h2>
         <i class="fa-regular fa-face-frown"></i>
        @else
       @foreach($courses as $course)
       <div class="col-md-4">
            <div class="card">
                <div class="course-poster overflow-hidden">
                    @if (filter_var($course->poster, FILTER_VALIDATE_URL))
                        <img src="{{ $course->poster }}" alt="Poster del corso" class="img-fluid">
                    @else
                        <img src="{{ asset('storage/' . $course->poster) }}" alt="Poster del corso" class="img-fluid">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text"><strong>Sensei:</strong> 
                        <ul class="list-unstyled">
                            @foreach ($course->teachers as $teacher)
                            <li>{{ $teacher->name }}</li>
                            @endforeach
                        </ul>
                    </p>
                    <p class="card-text"><strong>Laboratorio:</strong> {{ $course->room->name }}</p>
                    
                </div>
            </div>
       </div>
       @endforeach
       @endif
    </div>
</div>

@endsection