@extends('layouts.layout')
<!-- Fejléc kiszedés -->

@section('content')
<!-- Kontent kiszedés -->
 
    <div class="container mt-5">

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Új Szalon létrehozása</h5>
                <a href="{{ route('admin.dashboard') }}" id="yellowButton" class="btn btn-light">Mégsem</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.createSalon') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="salon_name" class="form-label">Szalon neve</label>
                        <input type="text" name="salon_name" id="salon_name" class="form-control" value="{{ old('salon_name') }}" required>
                        <p class="text-secondary">Maximum 20 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="short_information" class="form-label">Rövid információ</label>
                        <input type="text" name="short_information" id="short_information" class="form-control" value="{{ old('short_information') }}" required>
                        <p class="text-secondary">Maximum 100 karakterből/ betűből állhat.</p>
                    </div>

                    <div class="mb-3">
                        <label for="information" class="form-label">Részletes információ</label>
                        <textarea name="information" id="information" class="form-control" rows="4" required>{{ old('information') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Helyszín</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                        <p class="text-secondary">Javaslat: A helyszínnek tartalmaznia kell: az "út", "körút", "utca", "tér", "sétány", "főút" szót.</p>
                    </div>

                    <div class="mb-3">
                        <label for="owner_id" class="form-label">Tulajdonos</label>
                        <select name="owner_id" id="owner_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image_name" class="form-label">Kép URL</label>
                        <input type="text" name="image_name" id="image_name" class="form-control" value="{{ old('image_name') }}">
                    </div>

                    <button type="submit" id="button" class="btn btn-dark mt-3 w-100">Szalon létrehozása</button>
                </form>
            </div>
        </div>
    </div>
@endsection
