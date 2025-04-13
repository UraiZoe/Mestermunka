@extends('layouts.layout')
<!-- Fejléc kiszedés -->

@section("title", "Új esemény létrehozása")
<!-- Cím adás az oldalnak változó által -->
@section('content')
<!-- Kontent kiszedés -->
    
    <div class="container mt-5">
        <div class="card border rounded shadow-sm">
            <!-- Fejléc a kártya tetején -->
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Új Esemény Létrehozása</h2>
                <div class="d-flex">
                    <a href="{{ route('owner.dashboard') }}" id="button" class="btn btn-light me-2">Mégsem</a>
                    <form action="{{ route('owner.createEvent') }}" method="POST">
                        @csrf
                        <button type="submit" id="button" class="btn btn-dark">Esemény létrehozása</button>
                    </form>
                </div>
            </div>

            <!-- Tartalom -->
            <div class="card-body p-4">
                <form action="{{ route('owner.createEvent') }}" method="POST">
                    @csrf

                    <!-- Esemény Neve -->
                    <div class="form-group mb-3">
                        <label for="title">Esemény neve</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        <p class="text-secondary">Maximum 20 karakterből/ betűből állhat.</p>
                    </div>

                    <!-- Helyszín -->
                    <div class="form-group mb-3">
                        <label for="location">Helyszín</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                        <p class="text-secondary">Javaslat: A helyszínnek tartalmaznia kell: az "út", "körút", "utca", "tér", "sétány", "főút" szót.</p>
                    </div>

                    <!-- Rövid információ -->
                    <div class="form-group mb-3">
                        <label for="short_information">Rövid információ</label>
                        <input type="text" name="short_information" id="short_information" class="form-control" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <!-- Részletes információ -->
                    <div class="form-group mb-3">
                        <label for="information">Részletes információ</label>
                        <textarea name="information" id="information" class="form-control" required></textarea>
                    </div>

                    <!-- Kezdési időpont -->
                    <div class="form-group mb-3">
                        <label for="starts_at">Esemény kezdési időpontja</label>
                        <input type="datetime-local" name="starts_at" id="starts_at" class="form-control" required>
                    </div>

                    <!-- Kép URL -->
                    <div class="form-group mb-3">
                        <label for="image_name">Kép URL</label>
                        <input type="text" name="image_name" id="image_name" class="form-control">
                    </div>

                    <!-- Szalon kiválasztása -->
                    <div class="form-group mb-3">
                        <label for="salon_id">Válassza ki a szalont</label>
                        <select name="salon_id" id="salon_id" class="form-control" required>
                            <option value="">Válasszon egy szalont</option>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->salon_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" id="button" class="btn btn-dark mt-3 w-100">Esemény Létrehozása</button>
                </form>
            </div>
        </div>
    </div>
@endsection
