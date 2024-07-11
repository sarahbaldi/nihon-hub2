@extends('layouts.admin')

@section('courses')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Corso</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titolo corso -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $course->title }}">
                        </div>

                        
                        <!-- Laboratorio -->
                        <div class="mb-3">
                            <label for="room" class="form-label">Laboratorio</label>
                            <select name="room_id" id="room" class="form-control" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $course->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sensei -->
                        <div class="mb-3">
                            <label for="teachers" class="form-label">Sensei</label>
                            <select name="teachers[]" id="teachers" class="form-control" multiple required>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $course->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                        <!-- Descrizione -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $course->description }}</textarea>
                        </div>

                        <!-- Immagine -->
                        <div class="mb-3">
                            <label for="poster" class="form-label">Immagine</label>
                            <input type="file" name="poster" id="poster" class="form-control-file">
                            <img src="{{ asset('storage/' . $course->poster) }}" alt="{{ $course->title }}" class="img-thumbnail mt-2" style="max-width: 150px;">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection