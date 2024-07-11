@extends('layouts.admin')

@section('courses')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-5 bg-light rounded">
                <h2 class="mb-4">Inserisci Nuovo Corso</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Titolo del corso -->
                    <div class="form-group mb-3">
                        <label for="title" class="text-primary">Titolo</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Sensei -->
                    <div class="form-group mb-3">
                        <label for="teachers" class="text-warning">Sensei</label>
                        <select name="teachers[]" id="teachers" class="form-control" multiple required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    <!-- Laboratori -->
                    <div class="form-group mb-3">
                        <label for="room" class="text-success">Laboratorio</label>
                        <select name="room_id" id="room" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                                        
                    <!-- Descrizione del corso -->
                    <div class="form-group mb-3">
                        <label for="description" class="text-muted">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <!-- Immagine -->
                    <div class="form-group mb-4">
                        <label for="poster" class="text-primary">Immagine</label>
                        <input type="file" name="poster" id="poster" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection