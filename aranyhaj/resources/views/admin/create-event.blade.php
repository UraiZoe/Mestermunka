@extends('layouts.layout')
<!-- Fejléc kiszedés -->

@section('content')
<!-- Kontent kiszedés -->

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Új Esemény létrehozása</h5>
                <a href="{{ route('admin.dashboard') }}" id="yellowButton" class="btn btn-light">Mégsem</a>
            </div>
            <div class="card-body">
                <form id="eventForm" action="{{ route('admin.createEvent') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Esemény neve</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Helyszín</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                        <p class="text-secondary">Javaslat: A helyszínnek tartalmaznia kell: az "út", "körút", "utca", "tér", "sétány", "főút" szót.<p>
                    </div>

                    <div class="mb-3">
                        <label for="short_information" class="form-label">Rövid információ</label>
                        <input type="text" name="short_information" id="short_information" class="form-control" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="information" class="form-label">Részletes információ</label>
                        <textarea name="information" id="information" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="starts_at" class="form-label">Esemény kezdési időpontja</label>
                        <input type="datetime-local" name="starts_at" id="starts_at" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image_name" class="form-label">Kép URL</label>
                        <input type="text" name="image_name" id="image_name" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-dark mt-3 w-100">Esemény Létrehozása</button>
                </form>
            </div>
        </div>
    </div>
@endsection
