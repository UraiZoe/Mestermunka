@extends('layouts.layout')

@section("title", "Esemény módosítása")

@section('content')

    <div class="container mt-5">
        <div class="card border rounded shadow-sm">
            <!-- Fejléc -->
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Esemény módosítása</h2>
                <div class="d-flex">
                    <a href="{{ route('owner.dashboard') }}" id="button" class="btn btn-light me-2">Mégsem</a>
                    <form action="{{ route('owner.deleteEvent', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="button"  class="btn btn-danger">Esemény törlése</button>
                    </form>
                </div>
            </div>

            <!-- Kitöltös mezők -->
            <div class="card-body p-4">
                <form action="{{ route('owner.updateEvent', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Esemény neve -->
                    <div class="form-group mb-3">
                        <label for="title">Esemény neve</label>
                        <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                        <p class="text-secondary">Maximum 20 karakterből/ betűből állhat.</p>
                    </div>
                    
                    <!-- Helyszín -->
                    <div class="form-group mb-3">
                        <label for="location">Helyszín</label>
                        <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
                        <p class="text-secondary">Javaslat: A helyszínnek tartalmaznia kell: az "út", "körút", "utca", "tér", "sétány", "főút" szót.</p>   
                    </div>

                    <!-- Rövid információ -->
                    <div class="form-group mb-3">
                        <label for="short_information">Rövid információ</label>
                        <input type="text" name="short_information" class="form-control" value="{{ $event->short_information }}" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <!-- Részletes információ -->
                    <div class="form-group mb-3">
                        <label for="information">Részletes információ</label>
                        <textarea name="information" class="form-control" required>{{ old('information', $event->information) }}</textarea>
                    </div>

                    <!-- Kép URL -->
                    <div class="form-group mb-3">
                        <label for="image_name">Kép URL</label>
                        <input type="text" name="image_name" class="form-control" value="{{ $event->image_name }}">
                    </div>

                    <!-- Kezdés időpontja -->
                    <div class="form-group mb-3">
                        <label for="starts_at">Esemény kezdéi időpontja</label>
                        <input type="datetime-local" name="starts_at" class="form-control"
                            value="{{ old('starts_at', \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <button type="submit" id="button" class="btn btn-dark mt-3 w-100">Mentés</button>
                </form>
            </div>
        </div>
    </div>
@endsection
