@extends('layouts.admin')
@stack('css')
@section('surveys')

<div class="row">
    <div class="col-md-12">
        <h2>Elenco Corsi</h2>
        <div class="text-right mb-3">
            <a href="{{ route('courses.create') }}" class="btn btn-success">Inserisci Nuovo Corso</a>
        </div>

        {{-- Messaggi di errore e successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titolo
                            <a href="{{route('courses.index', ['sort' => $sort === 'title_asc' ? 'title_desc' : 'title_asc' ] ) }}">
                                <i class="fa-solid fa-circle-chevron-{{$sort === 'title_asc' ? 'down' : 'up'}} "></i>
                            </a>
                        </th>
                        <th>Immagine</th>
                        <th>Sensei
                            <a href="{{route('courses.index', ['sort' => $sort === 'teacher_asc' ? 'teacher_desc' : 'teacher_asc' ] ) }}">
                                <i class="fa-solid fa-circle-chevron-{{$sort === 'teacher_asc' ? 'down' : 'up'}} "></i>
                            </a>
                        </th>
                        <th>Laboratorio
                            <a href="{{route('courses.index', ['sort' => $sort === 'room_asc' ? 'room_desc' : 'room_asc' ] ) }}">
                                <i class="fa-solid fa-circle-chevron-{{$sort === 'room_asc' ? 'down' : 'up'}} "></i>
                            </a>
                        </th>
                        <th>Operazioni</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>
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
                        </td>
                        
                        
                        <td>
                            @foreach($course->teachers as $teacher)
                            {{ $teacher->name }}
                            @endforeach
                        </td>
                        
                        <td>{{ $course->room->name }}</td>

                        <td>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo corso?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
   {{-- modifichiamo la paginazione per non perdere l'ordinamento --}}
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
                    <a class="page-link" href="{{ $courses->appends(['sort' => $sort])->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif
            
            {{-- Link alle pagine --}}
            @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $courses->appends(['sort' => $sort])->url($page) }}">{{ $page }}</a>
                </li>
            @endforeach
            
            {{-- Link alla pagina successiva --}}
            @if ($courses->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $courses->appends(['sort' => $sort])->nextPageUrl() }}" aria-label="Next">
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


</div>
@endsection